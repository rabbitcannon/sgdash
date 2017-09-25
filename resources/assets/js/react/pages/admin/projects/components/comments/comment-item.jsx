import React, {Component} from "react";
import Moment from 'moment';
import Axios from 'axios';

const comment_update = '/api/v1/comment/update/';

class CommentItem extends React.Component {
    constructor(props) {
        super(props);

        this.state = {
			edit: false,
			comment: this.props.text,
			updated_at: this.props.updated_at
		}
	}

    handleToggleEdit = () => {
		if(this.state.edit == false) {
			this.setState({
				edit: true,
			});
		}
		else {
			this.setState({
				edit: false,
			});
		}
	}

	handleChange = (event) => {
    		this.setState({
			comment: event.target.value
		}, console.log(this.state.comment));
	}

	handleFormSubmit = (id) => {
    		let comment = $("textarea[name=comment-edit-" + id).val();

		Axios.put(comment_update + id, {
			comment: comment
		}).then(() => {
			this.setState({
				edit: false,
			});

		}).catch((error) => {
			console.log(error.response);
		});

		event.preventDefault();
	}

    dateFormatter = (date, format) => {
        if(format === 'compact') {
			return Moment(date).fromNow();
		}
		if(format === 'full') {
			return Moment(date).format('MMMM Do YYYY, h:mm:ss a');
		}
    }

	defineEditState = () => {
		if(this.props.user_id == this.props.poster_id && !this.state.edit) {
			return (
				<button id={"edit-comment-" + this.props.project_id} className="button" onClick={this.handleToggleEdit.bind(this)}>
					<i className="fa fa-pencil"></i> Edit
				</button>
			);
		}
		else if(this.props.user_id == this.props.poster_id && this.state.edit) {
			return (
				<div>
					<button className="button alert" onClick={this.handleToggleEdit.bind(this)}>
						<i className="fa fa-ban"></i> Cancel
					</button>

					<button className="button btn-save" onClick={this.handleFormSubmit.bind(this, this.props.id)}>
						<i className="fa fa-save"></i> Save
					</button>
				</div>
			);
		}
	}

	renderStaticOutput = () => {
    		var edited_date;
    		if(this.state.updated_at) {
			edited_date = "Edited at: " + this.dateFormatter(this.props.updated_at, 'full');
		}

		return (
			<div>
				<div className="row">
					<div className="large-3 columns">
						<div className="comment-avatar">
							<i className="fa fa-user-circle fa-3x"></i>
						</div>

						<div>
							{this.props.first_name} {this.props.last_name}
						</div>
					</div>

					<div className="large-9 columns text-left">
						<div>
							<span className="comment-date">
								{this.dateFormatter(this.props.date, 'full')} - <i>{this.dateFormatter(this.props.date, 'compact')}</i>
							</span>
						</div>
						<p>
							{this.state.comment}
						</p>

						<div>
							{this.defineEditState()}
						</div>

						<div>
							<small>
								{edited_date}
							</small>
						</div>
					</div>
				</div>

				<div>
					< hr />
				</div>
			</div>
		);
	}

	renderEditOutput = () => {
		return (
			<div>
				<div className="row">
					<div className="large-3 columns">
						<div className="comment-avatar">
							<i className="fa fa-user-circle fa-3x"></i>
						</div>

						<div>
							{this.props.first_name} {this.props.last_name}
						</div>
					</div>

					<div className="large-9 columns text-left">
						<div>
							<span className="comment-date">
								{this.dateFormatter(this.props.date, 'full')} - <i>{this.dateFormatter(this.props.date, 'compact')}</i>
							</span>
						</div>
						<p>
							<textarea rows='3' name={"comment-edit-" + this.props.id}
									  onChange={this.handleChange.bind(this)} defaultValue={this.state.comment}></textarea>
						</p>

						<div>
							{this.defineEditState()}
						</div>
					</div>
				</div>

				<div>
					< hr />
				</div>
			</div>
		);
	}

    render() {
        if(this.state.edit) {
			return this.renderEditOutput();
		}
		else {
			return this.renderStaticOutput();
		}
    }
}

export default CommentItem;