import React, {Component} from 'react';
import Axios from 'axios';
import toastr from 'toastr';
import RenderHTML from 'react-render-html';
import Moment from 'moment';
import _ from 'underscore';
import $ from 'jquery';

import ResultItem from './result-item.jsx';
import ResultFilter from './result-filter.jsx';

let url = window.location.origin + '/api/v1/projects';

class Results extends React.Component {
	constructor(props) {
		super(props);

		this.state = {
			projectResults: [],
			project_name: '',
			project_code: '',
		}
	}

	componentDidMount() {
		this.getProjects(url);
		toastr.options.newestOnTop = true;
		toastr.options.showMethod = 'slideDown';
	}

	_getProjectStatus = () => {
		var project_status = new Array();
		$.each($("input[name='project_status[]']:checked"), function() {
			project_status.push($(this).val());
		});
		console.log(project_status);
		return project_status;
	}

	_getProjectManagers = () => {
		var project_managers = new Array();
		$.each($("input[name='project_managers[]']:checked"), function() {
			project_managers.push($(this).val());
		});
		console.log(project_managers);
		return project_managers;
	}

	_getDevelopmentManagers = () => {
		var dev_managers = new Array();
		$.each($("input[name='dev_managers[]']:checked"), function() {
			dev_managers.push($(this).val());
		});
		console.log(dev_managers);
		return dev_managers;
	}
	_getAccountManagers = () => {
		var acct_managers = new Array();
		$.each($("input[name='acct_managers[]']:checked"), function() {
			acct_managers.push($(this).val());
		});
		console.log(acct_managers);
		return acct_managers;
	}

	updateProjects = (update_url, event) => {
		event.preventDefault();
		var loader = $('#loader');
		loader.show();

		var project_status = [];
		var project_managers = [];
		var dev_managers = [];
		var acct_managers = [];

		$('input[type="checkbox"]:checked').each(function() {
			var $this = $(this);
			var $name = $this.attr('name');

			switch ($name) {
				case "project_status[]":
					project_status.push(parseInt($this.val()));
					break;
				case "project_managers[]":
					project_managers.push(parseInt($this.val()));
					break;
				case "dev_managers[]":
					dev_managers.push(parseInt($this.val()));
					break;
				case "acct_managers[]":
					acct_managers.push(parseInt($this.val()));
					break;
			}
		});

		var current_time = $('#creation-date-start').val();
		var revert_time = Moment(current_time).format('YYYY-MM-DD HH:mm:ss');
		console.log(revert_time);

		Axios.post(update_url, {
			created_at: revert_time,
			// created_at: $('#creation-date-start').val(),
			project_code: $('input[name=project_code]').val(),
			project_name: $('input[name=project_name]').val(),
			project_status: project_status,
			project_managers: project_managers,
			dev_managers: dev_managers,
			acct_managers: acct_managers,
		}).then(function(response) {
			this.setState({
				count: response.data.length,
				projectResults: response.data
			});
			loader.fadeOut('slow');
			toastr.success('Results complete.');
		}.bind(this)).catch(function(error) {
			console.log(error);
			toastr.error('Unable to retrieve results, please try again.');
		});
	}

	getProjects(url) {
		var loader = $('#loader');
		loader.show();

		Axios.get(url).then(function(response) {
			this.setState({
				count: response.data.length,
				projectResults: response.data
			});
			loader.fadeOut('slow');
		}.bind(this)).catch(function(error) {
			console.log(error);
		});
	}

	render() {
		let renderedResults;

		if(this.state.count > 0) {
			renderedResults = _.map(this.state.projectResults, (project) => {
				return <ResultItem ref="results" key={project.id} comments={project.comments_count}
						   id={project.id} name={project.name} code={project.code} status={project.status}
						   acct_manager={project.acct_manager} dev_manager={project.dev_manager}
						   project_manager={project.project_manager} trend={project.trend}
						   req_eta={project.req_eta} req_status={project.req_status}
						   dev_eta={project.dev_eta} dev_status={project.dev_status}
						   qa_eta={project.qa_eta} qa_status={project.qa_status}
						   uat_eta={project.uat_eta} uat_status={project.uat_status}
						   prod_eta={project.prod_eta} prod_status={project.prod_status}
						   created_at={project.created_at} />
			});
		}
		else {
			renderedResults = RenderHTML("<tr><td colspan='9'>Sorry, no results found.</td></tr>");
		}

		return (
			<div>
				<ResultFilter updateProjects={this.updateProjects} />

				<div className="data-table">
					<div className="data-table-header">
						<div className="row expanded">
							<div className="large-10 columns">
								<i className="fa fa-bar-chart"></i> Current projects: <span className="counter">{this.state.projectResults.length}</span>
							</div>
							<div className="large-2 columns text-right">
								<a className="no-smoothState" data-toggle="add-project-reveal">
									<i className="fa fa-plus-circle"></i> Add
								</a>
							</div>
						</div>
					</div>

					<div className="data-table-content">

						<table className="idtable">
							<thead>
							<tr>
								<th>Code</th>
								<th>Name</th>
								<th>REQ</th>
								<th>DEV</th>
								<th>QA</th>
								<th>UAT</th>
								<th>PROD</th>
								<th>Trend</th>
								<th>Edit</th>
							</tr>
							</thead>

							<tbody>
								{renderedResults}
							</tbody>
						</table>

					</div>
				</div>

			</div>
		);
	}
}

export default Results;