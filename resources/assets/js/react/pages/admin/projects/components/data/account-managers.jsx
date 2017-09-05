import React from 'react';
import Axios from 'axios';
import _ from 'underscore';

class AccountManagers extends React.Component {
	constructor(props) {
		super(props);

		this.state = {
			acctManagers: [],
		}
	}

	componentDidMount() {
		this.getProjectStatus();
	}

	getProjectStatus() {
		if(this.state.acctManagers !== null) {
			var self = this;
			Axios.get('/api/v1/controls/manager/account').then(function (response) {
				self.setState({
					count: response.data.length,
					acctManagers: response.data
				});

			}.bind(this)).catch(function (error) {
				console.log(error);
			});
		}
	}

	render() {
		let managers = _.map(this.state.acctManagers, (user) => {
			return <option key={user.id} value={user.id}>{user.first_name} {user.last_name}</option>
		});

		return (
			<div>
				<select name="acct_manager" defaultValue={this.props.current}>
				  {managers}
				</select>
			</div>
		)
	}
}

export default AccountManagers;