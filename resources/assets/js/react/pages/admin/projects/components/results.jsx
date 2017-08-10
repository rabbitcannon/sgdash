import React, {Component} from 'react';
import Axios from 'axios';

import ResultItem from './result-item.jsx';
// import ResultFilter from './result-filter.jsx';

let url = window.location.origin + '/api/v1/projects';

class Results extends React.Component {
	constructor(props) {
		super(props);

		this.state = {
			projectResults: [],
			project_name: '',
			project_code: ''
		}

	}

	componentDidMount() {
	    this.getProjects(url);
    }

	getProjects(url) {
		var loader = jQuery('#loader');
		loader.show();

		var self = this;
		Axios.get(url).then(function(response) {
			self.setState({
				count: response.data.length,
				projectResults: response.data
			});

			loader.fadeOut('slow');
		}.bind(this)).catch(function(error) {
			console.log(error);
		});
	}

	filterList(event){
		this.setState({
			projectResults: event.target.value.substr(0,20)
		});
	}

    render() {
		let filteredProjects = this.state.projectResults.filter(
			(project) => {
				return project.name.indexOf(this.state.project_name) !== -1;
			}
		);

		let resultItems = filteredProjects.map((project) => {
			return <ResultItem ref="results" key={project.id} id={project.id} name={project.name} code={project.code}
				req_eta={project.req_eta} req_status={project.req_status}
				dev_eta={project.dev_eta} dev_status={project.dev_status}
				qa_eta={project.qa_eta} qa_status={project.qa_status}
				uat_eta={project.uat_eta} uat_status={project.uat_status}
				prod_eta={project.prod_eta} prod_status={project.prod_status} />
		});

		let emptyResults = "<div>empty</div>div>";

        return (
        	<div>
				<form action="">

					<fieldset className="fieldset">
						<legend>Filter By:</legend>
						<div className="row">
							<div className="large-6 columns">
								<label>Code
									<input type="text" placeholder="Project code" />
								</label>
							</div>

							<div className="large-6 columns">
								<label>Name
									<input type="text" value={this.state.project_name} placeholder="Project name" onChange={this.filterList.bind(this)} />
								</label>
							</div>
						</div>
					</fieldset>
				</form>
				<div className="data-table">
					<div className="data-table-header">
						<div className="row expanded">
							<div className="large-10 columns">
								<i className="fa fa-bar-chart" aria-hidden="true"></i> Current projects: <span className="counter">{this.state.projectResults.length}</span>
							</div>
							<div className="large-2 columns text-right">
								<a className="no-smoothState" data-toggle="add-project-reveal">
									<i className="fa fa-plus-circle" aria-hidden="true"></i> Add
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
								{resultItems}
							</tbody>
						</table>

					</div>
				</div>
			</div>
        );
    }
}

export default Results;