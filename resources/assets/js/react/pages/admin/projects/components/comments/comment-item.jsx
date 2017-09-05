import React, {Component} from "react";
import Moment from 'moment';

class CommentItem extends React.Component {
    constructor(props) {
        super(props);
    }

    dateFormatter(date, format) {
        if(format === 'compact') {
			return Moment(date).fromNow();
		}
		if(format === 'full') {
			return Moment(date).format('MMMM Do YYYY, h:mm:ss a');
		}
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