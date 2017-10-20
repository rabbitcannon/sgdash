import React from 'react';
import Axios from 'axios';
import _ from 'underscore';

class ProjectManagers extends React.Component {
	constructor(props) {
		super(props);

		this.state = {
			projectManagers: [],
		}
	}

	componentDidMount() {
		this.getProjectStatus();
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
			let select;
			if (user.id === this.props.current) {
				select = "true";
			}

			return <option key={user.id} value={user.id} selected={select}>{user.first_name} {user.last_name}</option>
		});

		return (
			<div>
				<select name="project_manager">
					{managers}
				</select>
			</div>
		)
	}
}

export default ProjectManagers;