import React, {Component} from "react";
import Moment from 'moment';

class CommentItem extends React.Component {
    constructor(props) {
        super(props);

        this.state = {
        	edit: false,
		}
    }

    handleEdit = () => {
    	this.setState({
			edit: true,
		}, console.log(this.state.edit));
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
		if(this.props.user_id == this.props.poster_id) {
			return (
				<button id={"edit-comment-" + this.props.project_id} className="button" onClick={this.handleEdit.bind(this)}>
					<i className="fa fa-pencil"></i> Edit
				</button>
			);
		}
		else {
			return false;
		}
	}

	renderStaticOutput = () => {

	}

	renderEditOutput = () => {

	}

    render() {
        return (
            <div>
                <div className="row">
                    <div className="large-3 columns">
                        <div className="comment-avatar">
                            <i className="fa fa-user-circle fa-3x"></i>
                        </div>
                        {this.props.first_name} {this.props.last_name}
                    </div>

                    <div className="large-9 columns text-left">
                        <div>
                            <span className="comment-date">
                                {this.dateFormatter(this.props.date, 'full')} - <i>{this.dateFormatter(this.props.date, 'compact')}</i>
                            </span>
                        </div>
                        <p>
                            {this.props.text}
                        </p>

						<div>
							Edit State: {this.state.edit}<br />
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
}

export default CommentItem;