<?php
namespace Deployer;
require 'recipe/laravel.php';

function get_build() {
  $build_dir = get('build_dir');
  $build_sha = getenv('CI_COMMIT_SHA');
  if ( !is_dir($build_dir)) {
    throw new InitializationException('Unable to open build directory!');
  }
  $build_file = "${build_sha}.tar.gz";
  if ( !file_exists( "$build_dir/$build_file") ) {
    throw new InitializationException("Unable to find build file $build_file");
  }
  return $build_file;
}

// Configuration

set('ssh_type', 'native');
set('ssh_multiplexing', false);

add('shared_files', []);
add('shared_dirs', []);

add('writable_dirs', []);

$DeployRun = getenv('DEPLOY_RUN') ?  getenv('DEPLOY_RUN') : 'ZZZ';
set('deploy_run', $DeployRun);

set('build_dir', 'builds');
set('build_file', get_build() );

// Servers

server('dev', 'sp-bns-dev-1.dev.gamelogic.com')
    ->user('deployer')
    ->forwardAgent()
    ->set('deploy_path', '/var/www/bumblebee/{{deploy_run}}')
    ->set('stage', 'dev')
    ->pty(true)
    ->stage('dev');

// QA
server('qa-1', 'spbns-qa-www-01.pawtest.gamelogic.com')
    ->user('deployer')
    ->forwardAgent()
    ->set('deploy_path', '/var/www/bumblebee/{{deploy_run}}')
    ->set('stage', 'qa')
    ->pty(true)
    ->stage('qa');
server('qa-2', 'spbns-qa-www-02.pawtest.gamelogic.com')
    ->user('deployer')
    ->forwardAgent()
    ->set('deploy_path', '/var/www/bumblebee/{{deploy_run}}')
    ->set('stage', 'qa')
    ->pty(true)
    ->stage('qa');

// UAT
server('uat-1', 'spbns-uat-www-01.pawtest.gamelogic.com')
    ->user('deployer')
    ->forwardAgent()
    ->set('deploy_path', '/var/www/bumblebee/{{deploy_run}}')
    ->set('stage', 'uat')
    ->pty(true)
    ->stage('uat');
server('uat-2', 'spbns-uat-www-02.pawtest.gamelogic.com')
    ->user('deployer')
    ->forwardAgent()
    ->set('deploy_path', '/var/www/bumblebee/{{deploy_run}}')
    ->set('stage', 'uat')
    ->pty(true)
    ->stage('uat');

// Prod
server('prod-1', 'spbns-prod-www-01.bns.gamelogic.com')
    ->user('deployer')
    ->forwardAgent()
    ->set('deploy_path', '/var/www/bumblebee/{{deploy_run}}')
    ->set('stage', 'prod')
    ->pty(true)
    ->stage('prod');
server('prod-2', 'spbns-prod-www-02.bns.gamelogic.com')
    ->user('deployer')
    ->forwardAgent()
    ->set('deploy_path', '/var/www/bumblebee/{{deploy_run}}')
    ->set('stage', 'prod')
    ->pty(true)
    ->stage('prod');

// Tasks

task('deploy:update_code', function() {
  upload('{{build_dir}}/{{build_file}}', '{{release_path}}');
  $output = run('cd {{release_path}} && /bin/tar xzf {{build_file}}');
});

task('deploy:mkwritable', function() {
  $dirs = get('writable_dirs');
  foreach ($dirs as $dir) {
    run("mkdir -p {{deploy_path}}/shared/$dir");
  }
});

task('vendor:publish', function(){
    $output = run('{{bin/php}} {{release_path}}/artisan vendor:publish');
    writeln('<info>' . $output . '</info>');
});

task('swagger:generate', function() {
    $output = run('{{bin/php}} {{release_path}}/artisan l5-swagger:generate');
    writeln('<info>' . $output . '</info>');
});

task('opcache:reset', function() {
    $output = run('/usr/local/sbin/cachetool.phar opcache:reset');
    writeln('<info>' . $output . '</info>');
});


task('deploy', [
    'deploy:prepare',
    'deploy:lock',
    'deploy:release',
    'deploy:update_code',
    'deploy:shared',
    'deploy:mkwritable',
    'deploy:writable',
    'artisan:view:clear',
    'artisan:cache:clear',
    'artisan:config:cache',
    'artisan:optimize',
    'artisan:migrate',
    'vendor:publish',
    'deploy:symlink',
    'opcache:reset',
    'deploy:unlock',
    'cleanup',
]);

after('deploy:failed', 'deploy:unlock');
