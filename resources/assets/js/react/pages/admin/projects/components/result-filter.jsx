import React, {Component} from "react";
import Axios from 'axios';
import _ from 'underscore';

import DatePickerStart from '../../../../components/universal/date-picker-start.jsx'
import DatePickerEnd from '../../../../components/universal/date-picker-end.jsx'

const url = '/admin/search/projects';
// const url = '/api/v1/projects';

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
    }

    getControlData = () => {
		Axios.all([
			Axios.get('/api/v1/controls/project-status'),
			Axios.get('/api/v1/controls/manager/project'),
			Axios.get('/api/v1/controls/manager/development'),
			Axios.get('/api/v1/controls/manager/account'),
        ]).then(Axios.spread(function (statuses, projectmans, devmans, acctmans) {
            this.setState({
                project_status: statuses.data,
                project_managers: projectmans.data,
                dev_managers: devmans.data,
                acct_managers: acctmans.data,
            });
        }.bind(this))).catch(function(error) {
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

		let projectManagerBoxes = _.map(this.state.project_managers, (projectmanager) => {
			return (
                <li>
                    <input type="checkbox" name="project_managers[]" key={projectmanager.id} defaultValue={projectmanager.id}/> <label>{projectmanager.first_name} {projectmanager.last_name}</label>
                </li>
			);
		});

		let devManagerBoxes = _.map(this.state.dev_managers, (devmanager) => {
			return (
                <li>
                    <input type="checkbox" name="dev_managers[]" key={devmanager.id} defaultValue={devmanager.id}/> <label>{devmanager.first_name} {devmanager.last_name}</label>
                </li>
            );
		});

		let acctManagerBoxes = _.map(this.state.acct_managers, (acctmanager) => {
			return (
                <li>
                    <input type="checkbox" name="acct_managers[]" key={acctmanager.id} defaultValue={acctmanager.id}/> <label>{acctmanager.first_name} {acctmanager.last_name}</label>
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
                                        <fieldset className="large-3 columns text-center">
                                            <legend>Creation Date</legend>
                                            <hr/>
                                            <DatePickerStart />
                                            <DatePickerEnd />
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
                                            </ul>
                                        </fieldset>
                                    </div>

                                    <div className="row expanded">
                                        <fieldset className="large-4 columns">
                                            <legend>Project Manager</legend>
                                            <hr/>

                                            <ul className="column-list">
                                                {projectManagerBoxes}
                                            </ul>
                                        </fieldset>

                                        <fieldset className="large-4 columns">
                                            <legend>Development Manager</legend>
                                            <hr/>

                                            <ul className="column-list">
                                                {devManagerBoxes}
                                            </ul>
                                        </fieldset>

                                        <fieldset className="large-4 columns">
                                            <legend>Account Manager</legend>
                                            <hr/>

                                            <ul className="column-list">
                                                {acctManagerBoxes}
                                            </ul>
                                        </fieldset>
                                    </div>

                                    <hr />
                                    <div className="row expanded">
                                        <div className="large-12 columns text-center pad-box">
                                            <button type="reset" className="button cancel-button">
                                                <i className="fa fa-times" aria-hidden="true"></i> Clear Form
                                            </button>

                                            <button id="search-btn" type="submit" className="button ">
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