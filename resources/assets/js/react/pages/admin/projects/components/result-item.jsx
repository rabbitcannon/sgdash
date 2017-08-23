import React from 'react';
import Moment from 'moment';
import Axios from 'axios';

const save_url = window.location.origin + '/api/v1/projects/update/';

class ResultItem extends React.Component {
	constructor(props) {
		super(props)

		this.state = {
			editing: false,
			req_status: this.props.req_status,
			dev_status: this.props.dev_status,
			qa_status: this.props.qa_status,
			uat_status: this.props.uat_status,
			prod_status: this.props.prod_status,
			trend: this.props.trend
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

	save(project_id) {
		var self = this;

		Axios.put(save_url + project_id, {
			code: $('[name="project_code"]').val(),
			name: $('[name="project_name"]').val(),
			//
			// acct_manager: $('[name="acct_manager"]').val(),
			// dev_manager: $('[name="dev_manager"]').val(),
			// project_manager: $('[name="project_manager"]').val(),
			//
			trend: $('[name="trend"]').val(),
			req_eta: $('[name="req_eta"]').val(),
			req_status: $('[name="req_status"]').val(),
			dev_eta: $('[name="dev_eta"]').val(),
			dev_status: $('[name="dev_status"]').val(),
			qa_eta: $('[name="qa_eta"]').val(),
			qa_status: $('[name="qa_status"]').val(),
			uat_eta: $('[name="uat_eta"]').val(),
			uat_status: $('[name="uat_status"]').val(),
			prod_eta: $('[name="prod_eta"]').val(),
			prod_status: $('[name="prod_status"]').val(),
		}).then(function () {
			self.setState({
				editing: false
			});

		}).catch(function (error) {
			console.log(error);
		});

		location.reload();
	}

	confirm(id) {
		if(confirm('Are you sure you want to delete this project?')){
			let url = `/api/v1/projects/delete/${id}`;
			window.location = url;
		}
	}

	dateFormatter(date, full) {
		if(full) {
			if(date) {
				var newDate = Moment(date).format('MM/DD/YY');
			}
			else {
				var newDate = "N/A";
			}
			return newDate;
		}
		else {
			if(date) {
				var newDate = Moment(date).format('MM/DD');
			}
			else {
				var newDate = "N/A";
			}
			return newDate;
		}
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

	classTrendSetter(trend) {
		let status_class = "";
		switch(trend) {
			case "up":
				status_class = "on-track"
				break;
			case "right":
				status_class = "caution"
				break;
			case "down":
				status_class = "at-risk"
				break;
			default:
				status_class = "disabled-text"
		}
		return status_class;
	}

	handleSelectChange(status_name, event) {
		if(status_name === 'req_status') {
			this.setState({
				req_status: event.target.value,
			});
		}
		if(status_name === 'dev_status') {
			this.setState({
				dev_status: event.target.value,
			});
		}
		if(status_name === 'qa_status') {
			this.setState({
				qa_status: event.target.value,
			});
		}
		if(status_name === 'uat_status') {
			this.setState({
				uat_status: event.target.value,
			});
		}
		if(status_name === 'prod_status') {
			this.setState({
				prod_status: event.target.value,
			});
		}
		if(status_name === 'trend') {
			this.setState({
				trend: event.target.value,
			});
		}
	}

	renderStaticDisplay() {
		return (
			<tr id="row-static">
				<td>
					{this.props.code}
				</td>
				<td>
					{this.props.name}
				</td>
				<td>
					<span className={this.classSetter(this.state.req_status)}>
						{this.dateFormatter(this.props.req_eta)}
					</span>
				</td>
				<td>
					<span className={this.classSetter(this.state.dev_status)}>
						{this.dateFormatter(this.props.dev_eta)}
					</span>
				</td>
				<td>
					<span className={this.classSetter(this.state.qa_status)}>
						{this.dateFormatter(this.props.qa_eta)}
					</span>
				</td>
				<td>
					<span className={this.classSetter(this.state.uat_status)}>
						{this.dateFormatter(this.props.uat_eta)}
					</span>
				</td>
				<td>
					<span className={this.classSetter(this.state.prod_status)}>
						{this.dateFormatter(this.props.prod_eta)}
					</span>
				</td>
				<td width="15">
					<span className={this.classTrendSetter(this.state.trend)}>
						<i className={"fa fa-2x fa-arrow-circle-" + this.props.trend}></i>
					</span>
				</td>
				<td width="50" className="text-center">
					<button id="initiate-edit" onClick={this.edit.bind(this)}>
						<i className="fa fa-pencil-square-o fa-2x"></i>
					</button>
				</td>
			</tr>
		);
	}

	renderEditForm() {
		var full = 'full';

		const styles = {
			main: {
				padding: 15,
				borderRadius: 5,
				textTransform: 'uppercase'
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
				<td colSpan={10}>

					<div className="text-left">
						<h3>Details</h3>
					</div>

					<div className="row expanded">
						<div className="large-3 columns">

							<div className="row">
								<div className="large-12 columns">
									<label>Project Code
										<input type="text" name="project_code" defaultValue={this.props.code} />
									</label>
								</div>
							</div>

							<div className="row">
								<div className="large-12 columns">
									<label>Project Name
										<input type="text" name="project_name" defaultValue={this.props.name} />
									</label>
								</div>
							</div>
						</div>

						<div className="large-9 columns">
							<div className="row">
								<div className="large-3 columns">
									<label>Trend
										<select name="trend" defaultValue={this.props.trend} onChange={this.handleSelectChange.bind(this, 'trend')}>
											<option style={styles.onTrack} value="up">Up</option>
											<option style={styles.caution} value="right">No Movement</option>
											<option style={styles.risk} value="down">Down</option>
										</select>
									</label>
								</div>
								<div className="large-3 columns">
									{/*<button onClick={() => {this.save(this.props.id)}} style={styles.main} className="success button">*/}
										{/*<i className="fa fa-save fa-2x"></i> Save*/}
									{/*</button>*/}
									{/*<button onClick={this.unEdit.bind(this)} style={styles.main} className="alert button">*/}
										{/*<i className="fa fa-ban fa-2x"></i> Cancel*/}
									{/*</button>*/}
									{/*<button onClick={() => {this.confirm(this.props.id)}} style={styles.main} className="button">*/}
										{/*<i className="fa fa-trash fa-2x"></i> Delete*/}
									{/*</button>*/}
								</div>
							</div>
						</div>
					</div>

					<div className="text-left">
						<h3>Environments</h3>
					</div>

					<div className="row expanded">

						<div className="large-12 columns">

							<div className="row expanded">
								<div className="columns">
									<div>
										<label>REQ
								 			<input type="text" name="req_eta" defaultValue={this.dateFormatter(this.props.req_eta, full)} />
										</label>
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

								<div className="columns">
									<div>
										<label>DEV
											<input type="text" name="dev_eta" defaultValue={this.dateFormatter(this.props.dev_eta, full)} />
										</label>
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

								<div className="columns">
									<div>
										<label>QA
											<input type="text" name="qa_eta" defaultValue={this.dateFormatter(this.props.qa_eta, full)} />
										</label>
									</div>
									<div>
										<label>Status
											<select name="qa_status" defaultValue={this.props.qa_status} onChange={this.handleSelectChange.bind(this, 'qa_status')}>
												<option style={styles.onTrack} value="1">On-Track</option>
												<option style={styles.caution} value="2">Caution</option>
												<option style={styles.risk} value="3">At-Risk</option>
											</select>
										</label>
									</div>
								</div>

								<div className="columns">
									<div>
										<label>UAT
											<input type="text" name="uat_eta" defaultValue={this.dateFormatter(this.props.uat_eta, full)} />
										</label>
									</div>
									<div>
										<label>Status
											<select name="uat_status" defaultValue={this.props.uat_status} onChange={this.handleSelectChange.bind(this, 'uat_status')}>
												<option style={styles.onTrack} value="1">On-Track</option>
												<option style={styles.caution} value="2">Caution</option>
												<option style={styles.risk} value="3">At-Risk</option>
											</select>
										</label>
									</div>
								</div>

								<div className="columns">
									<div>
										<label>PROD
											<input type="text" name="prod_eta" defaultValue={this.dateFormatter(this.props.prod_eta, full)} />
										</label>
									</div>
									<div>
										<label>Status
											<select name="prod_status" defaultValue={this.props.prod_status} onChange={this.handleSelectChange.bind(this, 'prod_status')}>
												<option style={styles.onTrack} value="1">On-Track</option>
												<option style={styles.caution} value="2">Caution</option>
												<option style={styles.risk} value="3">At-Risk</option>
											</select>
										</label>
									</div>
								</div>
							</div>
						</div>
					</div>

					<div className="row expanded">
						<div className="large-12 columns">
							<button onClick={() => {this.confirm(this.props.id)}} style={styles.main} className="button">
								<i className="fa fa-trash"></i> Delete
							</button>
							&nbsp;
							<button onClick={this.unEdit.bind(this)} style={styles.main} className="alert button">
								<i className="fa fa-ban"></i> Cancel
							</button>
							&nbsp;
							<button onClick={() => {this.save(this.props.id)}} style={styles.main} className="success button">
								<i className="fa fa-save"></i> Save
							</button>
						</div>
					</div>
				</td>
				
				{/*<td width="120">*/}
					{/*<input type="text" name="project_code" defaultValue={this.props.code} />*/}
				{/*</td>*/}
				{/*<td width="200">*/}
					{/*<input type="text" name="project_name" defaultValue={this.props.name} />*/}
				{/*</td>*/}
				{/*<td>*/}
					{/*<div>*/}
						{/*<div>*/}
							{/*<input type="text" name="req_eta" defaultValue={this.dateFormatter(this.props.req_eta, full)} />*/}
						{/*</div>*/}
						{/*<div>*/}
							{/*<label>Status*/}
								{/*<select name="req_status" defaultValue={this.props.req_status} onChange={this.handleSelectChange.bind(this, 'req_status')}>*/}
									{/*<option style={styles.onTrack} value="1">On-Track</option>*/}
									{/*<option style={styles.caution} value="2">Caution</option>*/}
									{/*<option style={styles.risk} value="3">At-Risk</option>*/}
								{/*</select>*/}
							{/*</label>*/}
						{/*</div>*/}
					{/*</div>*/}
				{/*</td>*/}
				{/*<td>*/}
					{/*<div>*/}
						{/*<div>*/}
							{/*<input type="text" name="dev_eta" defaultValue={this.dateFormatter(this.props.dev_eta, full)} />*/}
						{/*</div>*/}
						{/*<div>*/}
							{/*<label>Status*/}
								{/*<select name="dev_status" defaultValue={this.props.dev_status} onChange={this.handleSelectChange.bind(this, 'dev_status')}>*/}
									{/*<option style={styles.onTrack} value="1">On-Track</option>*/}
									{/*<option style={styles.caution} value="2">Caution</option>*/}
									{/*<option style={styles.risk} value="3">At-Risk</option>*/}
								{/*</select>*/}
							{/*</label>*/}
						{/*</div>*/}
					{/*</div>*/}
				{/*</td>*/}
				{/*<td>*/}
					{/*<div>*/}
						{/*<div>*/}
							{/*<input type="text" name="qa_eta" defaultValue={this.dateFormatter(this.props.qa_eta, full)} />*/}
						{/*</div>*/}
						{/*<div>*/}
							{/*<label>Status*/}
								{/*<select name="qa_status" defaultValue={this.props.qa_status} onChange={this.handleSelectChange.bind(this, 'qa_status')}>*/}
									{/*<option style={styles.onTrack} value="1">On-Track</option>*/}
									{/*<option style={styles.caution} value="2">Caution</option>*/}
									{/*<option style={styles.risk} value="3">At-Risk</option>*/}
								{/*</select>*/}
							{/*</label>*/}
						{/*</div>*/}
					{/*</div>*/}
				{/*</td>*/}
				{/*<td>*/}
					{/*<div>*/}
						{/*<div>*/}
							{/*<input type="text" name="uat_eta" defaultValue={this.dateFormatter(this.props.uat_eta, full)} />*/}
						{/*</div>*/}
						{/*<div>*/}
							{/*<label>Status*/}
								{/*<select name="uat_status" defaultValue={this.props.uat_status} onChange={this.handleSelectChange.bind(this, 'uat_status')}>*/}
									{/*<option style={styles.onTrack} value="1">On-Track</option>*/}
									{/*<option style={styles.caution} value="2">Caution</option>*/}
									{/*<option style={styles.risk} value="3">At-Risk</option>*/}
								{/*</select>*/}
							{/*</label>*/}
						{/*</div>*/}
					{/*</div>*/}
				{/*</td>*/}
				{/*<td>*/}
					{/*<div>*/}
						{/*<div>*/}
							{/*<input type="text" name="prod_eta" defaultValue={this.dateFormatter(this.props.prod_eta, full)} />*/}
						{/*</div>*/}
						{/*<div>*/}
							{/*<label>Status*/}
								{/*<select name="prod_status" defaultValue={this.props.prod_status} onChange={this.handleSelectChange.bind(this, 'prod_status')}>*/}
									{/*<option style={styles.onTrack} value="1">On-Track</option>*/}
									{/*<option style={styles.caution} value="2">Caution</option>*/}
									{/*<option style={styles.risk} value="3">At-Risk</option>*/}
								{/*</select>*/}
							{/*</label>*/}
						{/*</div>*/}
					{/*</div>*/}
				{/*</td>*/}
				{/*<td width="50">*/}
					{/*<div>*/}
						{/*<label>Trend*/}
							{/*<select name="trend" defaultValue={this.props.trend} onChange={this.handleSelectChange.bind(this, 'trend')}>*/}
								{/*<option style={styles.onTrack} value="up">Up</option>*/}
								{/*<option style={styles.caution} value="right">No Movement</option>*/}
								{/*<option style={styles.risk} value="down">Down</option>*/}
							{/*</select>*/}
						{/*</label>*/}
					{/*</div>*/}
				{/*</td>*/}
				{/*<td width="125" className="text-center">*/}
					{/*<button onClick={() => {this.save(this.props.id)}} style={styles.main}>*/}
						{/*<i className="fa fa-save fa-2x"></i>*/}
					{/*</button>*/}
					{/*<button onClick={this.unEdit.bind(this)} style={styles.main}>*/}
						{/*<i className="fa fa-ban fa-2x"></i>*/}
					{/*</button>*/}
					{/*<button onClick={() => {this.confirm(this.props.id)}} style={styles.main}>*/}
						{/*<i className="fa fa-trash fa-2x"></i>*/}
					{/*</button>*/}
				{/*</td>*/}
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