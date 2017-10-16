import React from 'react';
import Axios from 'axios';
import _ from 'underscore';

class ProjectStatusControl extends React.Component {
	constructor(props) {
		super(props);

		this.state = {
			projectStatus: [],
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
			// if (status.id === this.props.current) {
			// 	return <option key={status.id} value={status.id} selected>{status.name}</option>
			// }
			// else {
			return <option key={status.id} value={status.id}>{status.name}</option>
			// }
		});

		return (
			<div>
				<select name="status" value={this.props.current} onChange={this.handleChange}>
					{statuses}
				</select>
			</div>
		)
	}
}

export default ProjectStatusControl;