import React from 'react';
import Axios from 'axios';
import _ from 'underscore';

class ProjectStatusControl extends React.Component {
	constructor(props) {
		super(props);

		this.state = {
			projectStatus: [],
		}
	}

	componentDidMount() {
		this.getProjectStatus();
	}

	getProjectStatus() {
		if(this.state.projectStatus !== null) {
			var self = this;
			Axios.get('/api/v1/controls/project-status').then(function (response) {
				self.setState({
					count: response.data.length,
					projectStatus: response.data
				});
			}.bind(this)).catch(function (error) {
				console.log(error);
			});
		}
	}

	render() {
		let statuses = _.map(this.state.projectStatus, (status) => {
			return <option key={status.id} value={status.id}>{status.name}</option>
		});

		return (
			<div>
				<select name="status" defaultValue={this.props.current}>
				  {statuses}
				</select>
			</div>
		)
	}
}

export default ProjectStatusControl;