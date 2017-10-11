import React, {Component} from "react";
import Axios from 'axios';
import _ from 'underscore';

import DatePickerStart from '../../../../components/universal/date-picker-start.jsx'
import DatePickerEnd from '../../../../components/universal/date-picker-end.jsx'

class ResultFilter extends React.Component {
	constructor(props) {
		super(props);

		this.state = {
			project_status: [],
			project_managers: [],
			dev_managers: [],
			acct_managers: [],
		}
	}

	componentDidMount() {
		this.getControlData();
		this.tagToggle();
		this.clearTag();
		this.expandTags();
	}

	removeDates = () => {
		$('#creation-date-start').val("");
		$('#creation-date-end').val("");
	}

	getControlData = () => {
		Axios.all([
			Axios.get('/api/v1/controls/project-status'),
			Axios.get('/api/v1/controls/manager/project'),
			Axios.get('/api/v1/controls/manager/development'),
			Axios.get('/api/v1/controls/manager/account'),
		]).then(Axios.spread(function(statuses, projectmans, devmans, acctmans) {
			this.setState({
				project_status: statuses.data,
				project_managers: projectmans.data,
				dev_managers: devmans.data,
				acct_managers: acctmans.data,
			});
			$("div.tag-group").fadeIn(250);
		}.bind(this))).catch(function(error) {
			console.log(error);
		});
	}

	expandTags = () => {
		$('.expandable').find('a[href="#"]').on('click', function(e) {
			e.preventDefault();
			this.expand = !this.expand;
			$(this).text(this.expand ? "- less" : "+ more");
			$(this).closest('.expandable').find('.small-list, .big-list').toggleClass('small-list big-list');
		});
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

	clearTag = () => {
		$('ul#tag-container').on('click', '.tag ', function() {
			var $this = $(this);

			if ($this.attr('name') == "project_status[]") {
				var data_value = $(this).attr("data-value");
				var value = $(this).val();
				$this.remove();
				$("ul#status-tags").append("<li class='tag' name='project_status[]' data-value=" + data_value + " value=" + value + ">" +
					$this.attr('data-value') + "</li>");
			}

			if ($this.attr('name') == "project_managers[]") {
				var data_value = $(this).attr('data-value');
				var value = $(this).val();
				$this.remove();
				$("ul#pm-tags").append("<li class='tag pm' name='project_managers[]' data-value=\"" + data_value + "\" value=" + value + ">" +
					$this.attr('data-value') + "</li>");
			}

			if ($this.attr('name') == "dev_managers[]") {
				var data_value = $(this).attr('data-value');
				var value = $(this).val();
				$this.remove();
				$("ul#dm-tags").append("<li class='tag dm' name='dev_managers[]' data-value=\"" + data_value + "\" value=" + value + ">" +
					$this.attr('data-value') + "</li>");
			}

			if ($this.attr('name') == "acct_managers[]") {
				var data_value = $(this).attr('data-value');
				var value = $(this).val();
				$this.remove();
				$("ul#am-tags").append("<li class='tag am' name='acct_managers[]' data-value=\"" + data_value + "\" value=" + value + ">" +
					$this.attr('data-value') + "</li>");
			}
		});
	}

	clearForm = () => {
		$('ul#tag-container').find('.tag').each(function() {
			var $this = $(this);

			if ($this.attr('name') == "project_status[]") {
				var data_value = $(this).attr("data-value");
				var value = $(this).val();
				$this.remove();
				$("ul#status-tags").append("<li class='tag' name='project_status[]' data-value=" + data_value + " value=" + value + ">" +
					$this.attr('data-value') + "</li>");
			}

			if ($this.attr('name') == "project_managers[]") {
				var data_value = $(this).attr('data-value');
				var value = $(this).val();
				$this.remove();
				$("ul#pm-tags").append("<li class='tag pm' name='project_managers[]' data-value=\"" + data_value + "\" value=" + value + ">" +
					$this.attr('data-value') + "</li>");
			}

			if ($this.attr('name') == "dev_managers[]") {
				var data_value = $(this).attr('data-value');
				var value = $(this).val();
				$this.remove();
				$("ul#dm-tags").append("<li class='tag dm' name='dev_managers[]' data-value=\"" + data_value + "\" value=" + value + ">" +
					$this.attr('data-value') + "</li>");
			}

			if ($this.attr('name') == "acct_managers[]") {
				var data_value = $(this).attr('data-value');
				var value = $(this).val();
				$this.remove();
				$("ul#am-tags").append("<li class='tag am' name='acct_managers[]' data-value=\"" + data_value + "\" value=" + value + ">" +
					$this.attr('data-value') + "</li>");
			}
		});
	}

	render() {
		let searchType = "tags";

		const styles = {
			hide: {
				display: 'none'
			},
			icon: {
				marginLeft: 60
			},
		}

		let projectStatusTags = _.map(this.state.project_status, (status) => {
			return (
				<li className="tag" name="project_status[]" key={status.id} data-value={status.name} value={status.id}>
					{status.name}
				</li>
			);
		});

		let projectManagerTags = _.map(this.state.project_managers, (projectmanager) => {
			return (
				<li className="tag pm" name="project_managers[]" key={projectmanager.id}
					data-value={projectmanager.first_name + " " + projectmanager.last_name}
					value={projectmanager.id}>
					{projectmanager.first_name} {projectmanager.last_name}
				</li>
			);
		});

		let developmentManagerTags = _.map(this.state.dev_managers, (devmanager) => {
			return (
				<li className="tag dm" name="dev_managers[]" key={devmanager.id}
					data-value={devmanager.first_name + " " + devmanager.last_name}
					value={devmanager.id}>
					{devmanager.first_name} {devmanager.last_name}
				</li>
			);
		});

		let accountManagerTags = _.map(this.state.acct_managers, (acctmanager) => {
			return (
				<li className="tag am" name="acct_managers[]" key={acctmanager.id}
					data-value={acctmanager.first_name + " " + acctmanager.last_name}
					value={acctmanager.id}>
					{acctmanager.first_name} {acctmanager.last_name}
				</li>
			);
		});

		return (
			<div className="row expanded">
				<div className="large-12 columns">

					<div className="data-card-small">
						<div className="data-header">

							<div className="row expanded">
								<div className="large-11 columns">
									<i className="fa fa-filter"></i> Filter
								</div>

								<div className="large-1 columns">
									<button id="toggle-collapse" type="button" style={styles.icon}>
										<i id="collapse-chevron" className="fa fa-angle-double-up override"></i>
									</button>
								</div>
							</div>
						</div>

						<div className="data-content">
							<div id="filter-form">
								<form method="post" onSubmit={this.props.updateProjects.bind(this, searchType)}>
									<div className="row expanded">
										<fieldset className="large-4 columns">
											<legend>Creation Date</legend>
											<hr/>
											<div className="text-center">
												<DatePickerStart/>
												<DatePickerEnd/>
											</div>
										</fieldset>

										<fieldset className="large-4 columns">
											<legend>Project Code</legend>
											<hr/>
											<input type="text" name="project_code" placeholder="Project Code"/>
										</fieldset>

										<fieldset className="large-4 columns">
											<legend>Project Name</legend>
											<hr/>
											<input type="text" name="project_name" placeholder="Project Name"/>
										</fieldset>

									</div>

									<div className="row expanded">
										<div className="expandable large-12 columns tag-group" style={styles.hide}>
											<fieldset className="fieldset large-12 columns">
												<legend>Project Status</legend>
												<ul id="status-tags" name="project-status-tags"
													className="small-list column-list">
													{projectStatusTags}
												</ul>
												<div>
													<a href="#">+ more</a>
												</div>
											</fieldset>
										</div>
									</div>

									<div className="row expanded">
										<div className="expandable large-12 columns tag-group" style={styles.hide}>
											<fieldset className="fieldset large-12 columns">
												<legend>Project Managers</legend>
												<ul id="pm-tags" name="project-manager-tags"
													className="small-list column-list">
													{projectManagerTags}
												</ul>
												<div>
													<a href="#">+ more</a>
												</div>
											</fieldset>
										</div>
									</div>

									<div className="row expanded">
										<div className="expandable large-12 columns tag-group" style={styles.hide}>
											<fieldset className="fieldset large-12 columns">
												<legend>Development Managers</legend>
												<ul id="dm-tags" name="development-manager-tags"
													className="small-list column-list">
													{developmentManagerTags}
												</ul>
												<div>
													<a href="#">+ more</a>
												</div>
											</fieldset>
										</div>
									</div>

									<div className="row expanded">
										<div className="expandable large-12 columns tag-group" style={styles.hide}>
											<fieldset className="fieldset large-12 columns">
												<legend>Account Managers</legend>
												<ul id="am-tags" name="account-manager-tags"
													className="small-list column-list">
													{accountManagerTags}
												</ul>
												<div>
													<a href="#">+ more</a>
												</div>
											</fieldset>
										</div>
									</div>

									<div id="search-tags" className="row expanded">
										<div className="expandable large-12 columns tag-group">
											<fieldset className="fieldset large-12 columns">
												<legend>Search Tags</legend>
												<ul id="tag-container" className="small-list column-list"></ul>
											</fieldset>
										</div>
									</div>

									<div className="row expanded">
										<div className="large-12 columns text-center pad-box">
											<button id="clear-form" type="reset" className="button cancel-button"
													onClick={this.clearForm.bind(this)}>
												<i className="fa fa-times" aria-hidden="true"></i> Clear Form
											</button>

											<button id="search-btn" type="submit" className="button">
												<i className="fa fa-search" aria-hidden="true"></i> Search
											</button>
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		);
	}
}

export default ResultFilter;