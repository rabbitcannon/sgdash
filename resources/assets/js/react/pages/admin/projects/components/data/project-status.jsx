import React from 'react';
import Axios from 'axios';
import _ from 'underscore';

class ProjectStatus extends React.Component {
	constructor(props) {
		super(props);

		this.state = {
			projectStatus: [],
		}
	}

	componentDidMount() {
		this.getProjectStatus();
	}

	handleChange(event) {
		this.setState({value: event.target.value});
	}

	getProjectStatus() {
		if (this.state.projectStatus !== null) {
			var self = this;
			Axios.get('/api/v1/controls/project-status').then(function(response) {
				self.setState({
					count: response.data.length,
					projectStatus: response.data
				});
			}.bind(this)).catch(function(error) {
				console.log(error);
			});
		}
	}

	render() {
		let statuses = _.map(this.state.projectStatus, (status) => {
			let select;
			if (status.id === this.props.current) {
				select = "true";
			}

			return <option key={status.id} value={status.id} selected={select}>{status.name}</option>
		});

		return (
			<div>
				<select name="status">
					{statuses}
				</select>
			</div>
		)
	}
}

export default ProjectStatus;