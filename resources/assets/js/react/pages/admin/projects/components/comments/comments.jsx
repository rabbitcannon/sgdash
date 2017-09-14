import React, {Component} from "react";
import Axios from 'axios';
import _ from 'underscore';

import CommentItem from './comment-item.jsx';

const add_comment = '/admin/comment/add';
const user_id = $('input[name=user_id]').val();
// const add_comment = '/api/v1/comment/add';

class Comments extends React.Component {
    constructor(props) {
    	super(props);

    	this.state = {
    		user_id: user_id,
    		comments: [],
			count: '',
			project_id: this.props.project_id,
			comment_text: '',
			comment_container: ''
		}

		this.commentLoader = this.commentLoader.bind(this);
	}

	componentDidMount() {
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
		const $loader = $('div.comment-loader');

		this.closeCommentPanel();
		this.openCommentPanel(id);

		$underlay.fadeToggle(250);

		$loader.show();
		Axios.get(url).then(function(response) {
			this.setState({
				comments: response.data
			});
			$loader.hide();
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
		let btn_selector = event.target.id;
		let id = btn_selector.replace('add-comment-btn-', '');
		let project_id = id;
		let comment = $('textarea#comment-text-' + id).val();
		let url = '/api/v1/project/' + id + '/comments';

		Axios.post(add_comment, {
			user_id: user_id,
			project_id: project_id,
			comment: comment
		}).then((response) => {
			$('textarea#comment-text-' + id).val("");
			$('div#inner-comments-id-' + id).fadeOut(250);

			Axios.get(url).then((response) => {
				this.setState({
					comments: response.data
				});
				$('div#inner-comments-id-' + id).fadeIn(250);
			}).catch((error) => {
				console.log(error.response.data);
			});
		}).catch((error) => {
			console.log(error.response.data);
		});

	}

	handleChange(event) {
		this.setState({
			comment_text: event.target.value
		});
	}

    render() {
		var commentItems = _.map(this.state.comments, (comment, index) => {
			return <CommentItem ref="comments" key={index} id={comment.id} user_id={this.state.user_id} poster_id={comment.user.id}
								text={comment.comment} first_name={comment.user.first_name} last_name={comment.user.last_name}
								date={comment.created_at} project_id={comment.project_id} updated_at={comment.updated_at} />
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

								<div id={"inner-comments-id-" + this.props.project_id} className="data-content comments-inner">
									{commentItems}

									<form method="post" id={"form-id-" + this.props.project_id} data-form-id={this.props.project_id}>
										<div className="row">
											<div className="large-12 columns text-left">
												<label>Comment
													<textarea id={"comment-text-" + this.props.project_id} rows="5" defaultValue={this.state.comment_text} name="comment"
															  placeholder="Post a comment..." onChange={this.handleChange.bind(this)} />
													<input type="hidden" name="project_id" value={this.props.project_id} />
												</label>
											</div>
										</div>

										<div className="row">
											<div className="large-12 columns">
												<button id="cancel-btn" type="reset" className="button cancel-button">
													<i className="fa fa-ban" aria-hidden="true"></i> Reset
												</button>

												<button id={"add-comment-btn-" + this.props.project_id} className="button" onClick={this.handleSubmit.bind(this)} >
													<i className="fa fa-comment"></i> Add Comment
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