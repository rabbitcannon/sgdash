import React from 'react';
import Axios from 'axios';
import $ from 'jquery';
import toastr from 'toastr';

// import hideshowpassword from 'hideshowpassword';
let url = window.location.origin + '/api/v1/users';
require('hideshowpassword');

// const save_url = window.location.origin + '/api/v1/projects/update/';

class UserItem extends React.Component {
	constructor(props) {
		super(props)

		this.state = {
			editing: false,
			password: ''
		}
	}

	edit = () => {
		if(this.state.editing === false) {
			this.setState({
				editing: true,
			});
		}
		else {
			this.setState({
				editing: false,
			});
		}
	}

	save = (id) => {
		var url = `/api/v1/user/update/${id}`;

		Axios.put(url, {
			first_name: $('[name="first_name"]').val(),
			last_name: $('[name="last_name"]').val(),
			email: $('[name="email"]').val(),
			password: $('[name="password"]').val(),
		}).then(function () {
			self.setState({
				editing: false
			});

		}).catch(function (error) {
			console.log(error);
		});

		// location.reload();
	}

	confirm = (id) => {
		if(confirm('Are you sure you want to delete this user?')){
			let url = `/api/v1/user/delete/${id}`;
			window.location = url;

			Axios.get(url).then(function() {
				toastr.success('User has been deleted!');
				// this.props.user_list(url);
			}).catch(function(error) {
				console.log(error);
			});
		}
	}

	togglePasswordInput = (id) => {
		$('#pass-toggle-' + id).togglePassword();
	}

	componentDidMount() {
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});
	}

	renderEditSection = () => {
		const styles = {
			editRow: {
				backgroundColor: "#e7e7e7"
			},
			passButton: {
				color: "#e7e7e7",
				cursor: 'pointer',
				height: 37,
				fontWeight: 600,
				marginTop: -82,
				position: 'relative',
				right: -119,
				top: '50%',
			}
		}
		return (
			<tr id="row-edit" className="row-edit" style={styles.editRow}>
				<td colSpan={5}>
					<div className="row expanded">
						<div className="large-offset-3 large-3 columns">
							<label>First Name
								<input type="text" name="first_name" defaultValue={this.props.first_name} />
							</label>
						</div>

						<div className="large-3 columns">
							<label>Email Address
								<input type="text" name="email" defaultValue={this.props.email} />
							</label>
						</div>
					</div>

					<div className="row expanded">
						<div className="large-offset-3 large-3 columns">
							<label>Last Name
								<input type="text" name="last_name" defaultValue={this.props.last_name} />
							</label>
						</div>

						<div className="large-3 columns">
							<label>New Password
								<input id={"pass-toggle-" + this.props.id} type="password" name="password" />
								<div onClick={() => {this.togglePasswordInput(this.props.id)}} style={styles.passButton} className="button">
									show
								</div>
							</label>
						</div>
					</div>

					<div className="row expanded">
						<div className="large-12 columns">
							<button onClick={() => {this.confirm(this.props.id)}} className="button">
								<i className="fa fa-trash"></i> Delete
							</button>
							&nbsp;
							<button onClick={this.edit.bind(this)} className="alert button">
								<i className="fa fa-ban"></i> Cancel
							</button>
							&nbsp;
							<button onClick={() => {this.save(this.props.id)}} className="success button">
								<i className="fa fa-save"></i> Save
							</button>
						</div>
					</div>
				</td>
			</tr>
		);
	}

	renderStaticSection = () => {
		return (
			<tr id="row-static">
				<td>
					{this.props.first_name}
				</td>
				<td>
					{this.props.last_name}
				</td>
				<td>
					{this.props.email}
				</td>
				<td>
					{this.props.dateFormatter(this.props.created_at)}
				</td>
				<td>
					<button id="initiate-edit" onClick={this.edit.bind(this)}>
						<i className="fa fa-pencil-square-o fa-2x" aria-hidden="true"></i>
					</button>
				</td>
			</tr>
		);
	}

	render() {
		if(this.state.editing === false) {
			return this.renderStaticSection();
		}
		else {
			return this.renderEditSection();
		}
	}
}

export default UserItem;