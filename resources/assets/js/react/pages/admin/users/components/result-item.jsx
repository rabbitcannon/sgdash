import React from 'react';
import Moment from 'moment';
import Axios from 'axios';

const save_url = window.location.origin + '/api/v1/projects/update/';

class ResultItem extends React.Component {
	constructor(props) {
		super(props)

		this.state = {
			editing: false,
		}
	}

	componentDidMount() {
		jQuery.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});
	}

	edit() {
		this.setState({
			editing: true,
		});
	}

	unEdit() {
		this.setState({
			editing: false,
		});
	}

	save(user_id) {
		var self = this;

		Axios.put(save_url + user_id, {
			code: $('[name="first_name"]').val(),
			name: $('[name="last_name"]').val(),
			req_eta: $('[name="email"]').val(),
		}).then(function () {
			self.setState({
				editing: false
			});
		}).catch(function (error) {
			console.log(error);
		});
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

	classSetter(status_id) {
		let status_class = "";
		switch(status_id) {
			case 1:
				status_class = "on-track"
				break;
			case 2:
				status_class = "caution"
				break;
			case 3:
				status_class = "at-risk"
				break;
			default:
				status_class = "disabled-text"
		}
		return status_class;
	}

	urlCreator(user_id) {
		let url = '/admin/users/edit/' + user_id;
		return url;
	}

	renderStaticDisplay() {
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
					 {this.dateFormatter(this.props.created_at)}
				</td>
			</tr>
		);
	}

	renderEditForm() {
		var full = 'full';

		const styles = {
			main: {
				padding: 15,
			},
			onTrack: {
				color: '#4CAF50',
				fontWeight: 'bold'
			},
			caution: {
				color: '#FFAE00',
				fontWeight: 'bold'
			},
			risk: {
				color: '#EE5B57',
				fontWeight: 'bold'
			}
		}

		return (
			<tr id="row-edit" className="row-edit">
				<td width="120">
					<input type="text" name="project_code" defaultValue={this.props.code} />
				</td>
				<td width="200">
					<input type="text" name="project_name" defaultValue={this.props.name} />
				</td>
				<td>
					<div>
						<div>
							<input type="text" name="req_eta" defaultValue={this.dateFormatter(this.props.req_eta, full)} />
						</div>
						<div>
							<label>Status
								<select name="req_status" defaultValue={this.props.req_status} onChange={this.handleSelectChange.bind(this, 'req_status')}>
									<option style={styles.onTrack} value="1">On-Track</option>
									<option style={styles.caution} value="2">Caution</option>
									<option style={styles.risk} value="3">At-Risk</option>
								</select>
							</label>
						</div>
					</div>
				</td>
				<td>
					<div>
						<div>
							<input type="text" name="dev_eta" defaultValue={this.dateFormatter(this.props.dev_eta, full)} />
						</div>
						<div>
							<label>Status
								<select name="dev_status" defaultValue={this.props.dev_status} onChange={this.handleSelectChange.bind(this, 'dev_status')}>
									<option style={styles.onTrack} value="1">On-Track</option>
									<option style={styles.caution} value="2">Caution</option>
									<option style={styles.risk} value="3">At-Risk</option>
								</select>
							</label>
						</div>
					</div>
				</td>
				<td>
					<div>
						<div>
							<input type="text" name="qa_eta" defaultValue={this.dateFormatter(this.props.qa_eta, full)} />
						</div>
						<div>
							<label>Status
								<select name="qa_status" value={this.props.qa_status} onChange={this.handleSelectChange.bind(this, 'qa_status')}>
									<option style={styles.onTrack} value="1">On-Track</option>
									<option style={styles.caution} value="2">Caution</option>
									<option style={styles.risk} value="3">At-Risk</option>
								</select>
							</label>
						</div>
					</div>
				</td>
				<td>
					<div>
						<div>
							<input type="text" name="uat_eta" defaultValue={this.dateFormatter(this.props.uat_eta, full)} />
						</div>
						<div>
							<label>Status
								<select name="uat_status" value={this.props.uat_status} onChange={this.handleSelectChange.bind(this, 'uat_status')}>
									<option style={styles.onTrack} value="1">On-Track</option>
									<option style={styles.caution} value="2">Caution</option>
									<option style={styles.risk} value="3">At-Risk</option>
								</select>
							</label>
						</div>
					</div>
				</td>
				<td>
					<div>
						<div>
							<input type="text" name="prod_eta" defaultValue={this.dateFormatter(this.props.prod_eta, full)} />
						</div>
						<div>
							<label>Status
								<select name="prod_status" value={this.props.prod_status} onChange={this.handleSelectChange.bind(this, 'prod_status')}>
									<option style={styles.onTrack} value="1">On-Track</option>
									<option style={styles.caution} value="2">Caution</option>
									<option style={styles.risk} value="3">At-Risk</option>
								</select>
							</label>
						</div>
					</div>
				</td>
				<td>
					positive - static
				</td>
				<td width="125" className="text-center">
					<button onClick={() => {this.save(this.props.id)}} style={styles.main}>
						<i className="fa fa-save fa-2x" aria-hidden="true"></i>
					</button>
					<button onClick={this.unEdit.bind(this)}>
						<i className="fa fa-ban fa-2x" aria-hidden="true"></i>
					</button>
				</td>
			</tr>
		);
	}

	render() {
		if(this.state.editing === false) {
			return this.renderStaticDisplay();
		}
		else {
			return this.renderEditForm();
		}
	}
}

export default ResultItem;