import React, {Component} from "react";
import Axios from 'axios';
import _ from 'underscore';

const url = '/admin/search/projects';
// const url = '/api/v1/projects';

class ResultFilter extends React.Component {
    constructor(props) {
        super(props);

        this.state = {
            project_status: [],
            dev_managers: []
        }
    }

    componentDidMount() {
        this.getProjectStatus();
        this.getDevManagers();
    }

	getProjectStatus = () => {
		Axios.get('/api/v1/controls/project-status').then(function(response) {
			this.setState({
				project_status: response.data
			});
		}.bind(this)).catch((error) => {
			console.log(error);
		});
	}

    getDevManagers = () => {
        Axios.get('/api/v1/controls/manager/development').then(function(response) {
            this.setState({
				dev_managers: response.data
			});
        }.bind(this)).catch((error) => {
            console.log(error);
        });
    }

    render () {
        const styles = {
            icon: {
                marginLeft: 60
            }
        }

		let projectStatusBoxes = _.map(this.state.project_status, (status) => {
			return (
                <li>
                    <input type="checkbox" name="project_status[]" key={status.id} defaultValue={status.id}/> <label>{status.name}</label>
                </li>
			);
		});

		let devManagerBoxes = _.map(this.state.dev_managers, (manager) => {
			return (
                <li>
                    <input type="checkbox" name="dev_managers[]" key={manager.id} defaultValue={manager.id}/> <label>{manager.first_name} {manager.last_name}</label>
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
                                <form method="post" onSubmit={this.props.updateProjects.bind(this, url)}>
                                    <div className="row expanded">
                                        <fieldset className="large-3 columns">
                                            <legend>Creation Date</legend>
                                            <hr/>
                                            <div id="date-picker-start"></div>
                                            <div id="date-picker-end"></div>
                                        </fieldset>

                                        <fieldset className="large-3 columns">
                                            <legend>Project Code</legend>
                                            <hr/>
                                            <input type="text" name="project_code" placeholder="Project Code" />
                                        </fieldset>

                                        <fieldset className="large-3 columns">
                                            <legend>Project Name</legend>
                                            <hr/>
                                            <input type="text" name="project_name" placeholder="Project Name" />
                                        </fieldset>

                                        <fieldset className="large-3 columns">
                                            <legend>Project Status</legend>
                                            <hr/>

                                            <ul name="project-status-list" className="column-list">
                                                {projectStatusBoxes}
                                                {/*<li>*/}
                                                    {/*/!*<input className="project_status" name="project_status[]" value="{!! $project_status->id !!}" type="checkbox" />*!/*/}

                                                        {/*<label>*/}
                                                            {/*/!*{!! $project_status->name !!}*!/*/}
                                                        {/*</label>*/}
                                                {/*</li>*/}
                                            </ul>
                                        </fieldset>
                                    </div>

                                    <input type="submit" className="button" value="BUTTON SON!" />

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