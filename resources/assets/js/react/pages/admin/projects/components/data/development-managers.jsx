import React from 'react';
import Axios from 'axios';
import _ from 'underscore';

class DevelopmentManagers extends React.Component {
	constructor(props) {
		super(props);

		this.state = {
			devManagers: [],
		}
	}

	componentDidMount() {
		this.getProjectStatus();
	}

	getProjectStatus() {
		if (this.state.devManagers !== null) {
			var self = this;
			Axios.get('/api/v1/controls/manager/development').then(function(response) {
				self.setState({
					count: response.data.length,
					devManagers: response.data
				});
			}.bind(this)).catch(function(error) {
				console.log(error);
			});
		}
	}

	render() {
		let managers = _.map(this.state.devManagers, (user) => {
			let select;
			if (user.id === this.props.current) {
				select = "true";
			}

			return <option key={user.id} value={user.id} selected={select}>{user.first_name} {user.last_name}</option>
		});

		return (
			<div>
				<select name="dev_manager">
					{managers}
				</select>
			</div>
		)
	}
}

export default DevelopmentManagers;