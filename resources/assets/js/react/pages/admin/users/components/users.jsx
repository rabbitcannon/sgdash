import React, {Component} from 'react';
import Moment from 'moment';
import Axios from 'axios';

import UserItem from './user-item.jsx';

let url = window.location.origin + '/api/v1/users';

class Users extends React.Component {
	constructor(props) {
		super(props);

		this.state = {
			userResults: [],
		}
	}

	componentDidMount = () => {
	    this.getUsers(url);
    }

	dateFormatter(date) {
		if(date) {
			var newDate = Moment(date).format('MM/DD/YY');
		}
		else {
			var newDate = "N/A";
		}
		return newDate;
	}

	getUsers = (url) => {
		var loader = jQuery('#loader');
		loader.show();

		var self = this;
		Axios.get(url).then(function(response) {
			self.setState({
				count: response.data.length,
				userResults: response.data
			});

			loader.fadeOut('slow');
		}.bind(this)).catch(function(error) {
			console.log(error);
		});
	}

    render() {
		let users_list = this.state.userResults.map((user, i) => {
			return <UserItem ref="results" key={user.id} id={user.id} first_name={user.first_name} last_name={user.last_name}
				email={user.email} created_at={user.created_at} dateFormatter={this.dateFormatter} user_list={this.getUsers}/>
		});

        return (
			<div>
				<div className="data-table">
					<div className="data-table-header">

						<div className="row expanded">
							<div className="large-10 columns">
								<i className="fa fa-user" aria-hidden="true"></i> Current users: <span className="counter">{this.state.userResults.length}</span>
							</div>
							<div className="large-2 columns text-right">
								<a className="no-smoothState" data-toggle="add-user-reveal">
									<i className="fa fa-plus-circle" aria-hidden="true"></i> Add
								</a>
							</div>
						</div>
					</div>

					<div className="data-table-content">

						<table className="idtable">
							<thead>
							<tr>
								<th>First Name</th>
								<th>Last Name</th>
								<th>Email Address</th>
								<th>Created On</th>
								<th>Edit</th>
							</tr>
							</thead>

							<tbody>
								{users_list}
							</tbody>
						</table>

					</div>
				</div>
			</div>
        );
    }
}

export default Users;