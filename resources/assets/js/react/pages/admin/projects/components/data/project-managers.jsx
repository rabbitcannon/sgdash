import React from 'react';
import Axios from 'axios';
import _ from 'underscore';

class ProjectManagers extends React.Component {
	constructor(props) {
		super(props);

		this.state = {
			projectManagers: [],
			value: this.props.current
		}

		this.handleChange = this.handleChange.bind(this);
	}

	componentDidMount() {
		this.getProjectStatus();
	}

	handleChange(event) {
		this.setState({value: event.target.value});
	}

	getProjectStatus() {
		if (this.state.projectManagers !== null) {
			var self = this;
			Axios.get('/api/v1/controls/manager/project').then(function(response) {
				self.setState({
					count: response.data.length,
					projectManagers: response.data
				});
			}.bind(this)).catch(function(error) {
				console.log(error);
			});
		}
	}

	render() {
		let managers = _.map(this.state.projectManagers, (user) => {
			return <option key={user.id} value={user.id}>{user.first_name} {user.last_name}</option>
		});

		return (
			<div>
				<select name="project_manager" value={this.props.current} onChange={this.handleChange}>
					{managers}
				</select>
			</div>
		)
	}
}

export default ProjectManagers;