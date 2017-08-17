import React, {Component} from "react";
import _ from 'underscore';

import ResultItem from './result-item.jsx';

class ResultFilter extends React.Component {
	constructor(props) {
		super(props);

		this.state = {
			projects: '',
			project_name: ''
		}
	}

	filterList(event){
		this.setState({
			project_name: event.target.value
		});
	}

    render() {
		console.log(this.state.project_name);

		let filteredProjects = _.filter(this.props.projects,
			(project) => {
				return project.name.toLowerCase().indexOf(this.state.project_name) >= 0;
			}
		);

		let resultItems = _.map(filteredProjects, (project) => {
			return <ResultItem ref="results" key={project.id} id={project.id} name={project.name} code={project.code}
							   req_eta={project.req_eta} req_status={project.req_status}
							   dev_eta={project.dev_eta} dev_status={project.dev_status}
							   qa_eta={project.qa_eta} qa_status={project.qa_status}
							   uat_eta={project.uat_eta} uat_status={project.uat_status}
							   prod_eta={project.prod_eta} prod_status={project.prod_status} />
		});

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
									<input type="text" defaultValue={this.state.project_name} placeholder="Project name" onChange={this.filterList.bind(this)} />
								</label>
							</div>
						</div>
					</fieldset>
				</form>
				{resultItems}
            </div>
        );
    }
}

export default ResultFilter;