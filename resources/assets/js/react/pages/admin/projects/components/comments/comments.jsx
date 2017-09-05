import React, {Component} from "react";
import Axios from 'axios';
import _ from 'underscore';

import CommentItem from './comment-item.jsx';

const add_comment = '/api/v1/comment/add';
const $loader = $('.comment-loader');

class Comments extends React.Component {
    constructor(props) {
    	super(props);

    	this.state = {
    		comments: [],
			count: '',
			project_id: this.props.project_id,
			comment_project_id: '',
			comment_user_id: '',
			comment_submit: '',
		}

		this.commentLoader = this.commentLoader.bind(this);
		this.handleSubmit = this.handleSubmit.bind(this);
	}

	componentDidMount() {
    	$loader.hide();
		$(document).ready(function() {
			$('.comment-link').on('click', function (event) {
				event.preventDefault();
			});

			$('div#comment-underlay').on('click', function() {
				var fetch_id = $('div').find("[data-state='open']").attr('id');
				$('#' + fetch_id).attr('data-state', 'closed').removeClass('fadeInRight').addClass('fadeOutRight');
				$(this).fadeOut(250);
			});

			$('div.comment-close').on('click', function() {
				var fetch_id = $('div').find("[data-state='open']").attr('id');
				$('#' + fetch_id).attr('data-state', 'closed').removeClass('fadeInRight').addClass('fadeOutRight');
				$('div#comment-underlay').fadeOut(250);
			})
		});
	}

	commentLoader(id) {
		let url = `/api/v1/project/${id}/comments`;
		var $underlay = $('div#comment-underlay');

		this.closeCommentPanel();
		this.openCommentPanel(id);

		$underlay.fadeToggle(250);

		$loader.show();
		Axios.get(url).then(function(response) {
			this.setState({
				comments: response.data
			}, function() {
				$loader.hide();
			});
		}.bind(this)).catch(function(error) {
			console.log(error);
		});
	}

	closeCommentPanel() {
		var fetch_id = $('div').find("[data-state='open']").attr('id');
		$('#' + fetch_id).attr('data-state', 'closed');
		$('#' + fetch_id).removeClass('fadeInRight').addClass('fadeOutRight');
	}

	openCommentPanel(id) {
		let selected_div = $('div').find(`[data-id='${id}']`);
		$(selected_div).css('display', 'block').addClass('animated fadeInRight').removeClass('fadeOutRight');
		$(selected_div).attr('data-state', 'open');
	}

	handleSubmit(event) {
		event.preventDefault();
		// console.log($(this));
	}

	handleChange(event) {
    	var self = this;
		self.setState({comment_submit: event.target.value});
		console.log(this.state.comment_submit);
	}

	// addComment(event) {
	// 	event.preventDefault();
	// 	var form = $(this).closest("form").attr("id");
	// 	console.log(form);
	//
	//
	// 	// console.log($(selected_div).parents("form").attr('data-form-id'));
	//
	//
	// 	// console.log("User: " + $('[name="user_id"]').val());
	// 	// console.log("Project: " + $('[name="project_id"]').val());
	// 	// console.log("Comment: " + $('[name="comment"]').val());
	//
	// 	// Axios.post(add_comment, {
	// 	// 	user_id: $('[name="user_id"]').val(),
	// 	// 	project_id: $('[name="project_id"]').val(),
	// 	// 	comment: $('[name="comment"]').val()
	// 	// }).then(function () {
	// 	// 	// self.setState({
	// 	//
	// 	// }).catch(function (error) {
	// 	// 	console.log(error);
	// 	// });
	// }

    render() {
		var commentItems = _.map(this.state.comments, (comment, index) => {
			return <CommentItem ref="comments" key={index} id={comment.id} text={comment.comment}
								first_name={comment.user.first_name} last_name={comment.user.last_name}
								date={comment.created_at} />
		});

    	return (
			<div className="comment-container">
				<a className="comment-link" onClick={this.commentLoader.bind(this, this.props.project_id)}>
					<small><i className="fa fa-comments"></i> comments: {this.props.count}</small>
				</a>

				<div id={this.props.project_id} className="comment-slider" data-id={this.props.project_id} data-state="closed">
					<div className="comment-loader">
						<img src="/images/preloaders/loader.svg" />
					</div>
					<div className="comment-close">
						<i className="fa fa-times fa-2x"></i>
					</div>
					<div className="row collapse">
						<div className="large-12 columns">

							<div className="data-card-small">
								<div className="data-header text-left">
									<i className="fa fa-comments"></i> Comments
								</div>

								<div className="data-content comments-inner">
									{commentItems}

									<form method="post" data-form-id={this.props.project_id} onSubmit={this.handleSubmit}>
										<div className="row">
											<div className="large-12 columns text-left">
												<label>Comment
													<textarea rows="5" name="comment" placeholder="Post a comment..." onChange={this.handleChange.bind(this)} />
													<input type="hidden" name="project_id" value={this.props.project_id} />
												</label>
											</div>
										</div>

										<div className="row">
											<div className="large-12 columns">
												<button id="cancel-btn" type="reset" className="button cancel-button">
													<i className="fa fa-ban" aria-hidden="true"></i> Reset
												</button>

												<button id={"add-comment-btn-" + this.props.project_id} className="button">
													<i className="fa fa-comment" aria-hidden="true"></i> Add Comment
												</button>
											</div>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		)
    }
}

export default Comments;