import React, {Component} from 'react';
import Axios from 'axios';
import toastr from 'toastr';
import RenderHTML from 'react-render-html';
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
		this.accordionPanel();
		this.tagToggle();
		this.clearTagRunner();
		toastr.options.newestOnTop = true;
		toastr.options.showMethod = 'slideDown';
	}

	componentDidUpdate = () => {
		// this.hideSearchTagPanel();
		// easier to do this in state probably
	}

	accordionPanel = () => {
		$(document).ready(function() {
			$('button#toggle-collapse').on('click', function() {
				$('div#filter-form').animate({opacity: 'toggle', height: 'toggle'}, 250, "linear");

				var $chevron = $('i#collapse-chevron');
				$chevron.toggleClass('fa-angle-double-up fa-angle-double-down');
			});
		});
	}

	hideSearchTagPanel = () => {
		if($("ul#tag-container li").length > 0) {
			console.log('has lis');
			$("div#search-tags").show();
		}
		else {
			console.log('no lis');
			$("div#search-tags").hide();
		}
	}

	updateProjects = (update_url, event) => {
		event.preventDefault();
		event.stopPropagation()
		var loader = $('#loader');
		loader.show();

		var start_date = $('#creation-date-start').val();
		var end_date = $('#creation-date-end').val();

		var project_status = [];
		var project_managers = [];
		var dev_managers = [];
		var acct_managers = [];

		$('ul#tag-container li').each(function() {
		// $('input[type="checkbox"]:checked').each(function() {
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

		$('#creation-date-start').val(start_date);
		$('#creation-date-end').val(end_date);

		// console.log(start_date);
		// console.log(end_date);

		// this.tagRunner();

		Axios.post(update_url, {
			created_at: $('#creation-date-start').val(),
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

		// var hidden = $('div#filter-form').is(':hidden');
		//
		// if(!hidden) {
		// 	$('div#filter-form').animate({opacity: 'toggle', height: 'toggle'}, 250, "linear");
		//
		// 	var $chevron = $('i#collapse-chevron');
		// 	$chevron.toggleClass('fa-angle-double-up fa-angle-double-down');
		// }
	}

	tagToggle = () => {
		var $tags = $("ul#tag-container");

		$('#status-tags').on('click', '.tag', function(event) {
			event.preventDefault();

			var $this = $(this);
			var data_value = $this.attr('data-value');
			var value = $this.val();

			$this.remove();
			$tags.append("<li class='tag selected' name='project_status[]' data-value=" + data_value + " value=" + value + ">" +
				$this.attr('data-value') + "</li>");
		});

		$('#pm-tags').on('click', '.tag', function(event) {
			event.preventDefault();

			var $this = $(this);
			var data_value = $this.attr("data-value");
			var value = $this.val();

			$this.remove();
			$tags.append("<li class='tag pm selected' name='project_managers[]' data-value=\"" + data_value + "\" value=" + value + ">" +
				$this.attr('data-value') + "</li>");
		});

		$('#dm-tags').on('click', '.tag', function(event) {
			event.preventDefault();

			var $this = $(this);
			var data_value = $this.attr("data-value");
			var value = $this.val();

			$this.remove();
			$tags.append("<li class='tag dm selected' name='dev_managers[]' data-value=\"" + data_value + "\" value=" + value + ">" +
				$this.attr('data-value') + "</li>");
		});

		$('#am-tags').on('click', '.tag', function(event) {
			event.preventDefault();

			var $this = $(this);
			var data_value = $this.attr("data-value");
			var value = $this.val();

			$this.remove();
			$tags.append("<li class='tag am selected' name='acct_managers[]' data-value=\"" + data_value + "\" value=" + value + ">" +
				$this.attr('data-value') + "</li>");
		});
	}

	clearTagRunner = () => {
		$('ul#tag-container').on('click', '.tag ', function() {
			var $this = $(this);

			if($this.attr('name') == "project_status[]") {
				var data_value = $(this).attr("data-value");
				var value = $(this).val();
				$this.remove();
				$("ul#status-tags").append("<li class='tag' name='project_status[]' data-value=" + data_value + " value=" + value + ">" +
					$this.attr('data-value') + "</li>");
			}

			if($this.attr('name') == "project_managers[]") {
				var data_value = $(this).attr('data-value');
				var value = $(this).val();
				$this.remove();
				$("ul#pm-tags").append("<li class='tag pm' name='project_managers[]' data-value=\"" + data_value + "\" value=" + value + ">" +
					$this.attr('data-value') + "</li>");
			}

			if($this.attr('name') == "dev_managers[]") {
				var data_value = $(this).attr('data-value');
				var value = $(this).val();
				$this.remove();
				$("ul#dm-tags").append("<li class='tag dm' name='dev_managers[]' data-value=\"" + data_value + "\" value=" + value + ">" +
					$this.attr('data-value') + "</li>");
			}

			if($this.attr('name') == "acct_managers[]") {
				var data_value = $(this).attr('data-value');
				var value = $(this).val();
				$this.remove();
				$("ul#am-tags").append("<li class='tag am' name='acct_managers[]' data-value=\"" + data_value + "\" value=" + value + ">" +
					$this.attr('data-value') + "</li>");
			}
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