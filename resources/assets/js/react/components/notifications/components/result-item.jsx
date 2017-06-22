import React from 'react';

class ResultItem extends React.Component {
	constructor(props) {
		super(props);

		this.state = {
			data: this.props.data,
			id: this.props.id,
			read_at: this.props.read_at
		}

	}

	componentDidMount() {
		this.markAsReadHover();
		jQuery.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});
	}

	markAsReadHover() {
		// $(document).ready(function () {
			$('.mark-read i').hover(function () {
				$(this).toggleClass('fa-envelope-open');
			});
		// });
	}

	notificationRead(notification_env, notification_status, notification_url) {

		return (
			<div className="row mark-read">
				<div className="large-10 columns text-left">
					Environment: {notification_env} - {notification_status}
				</div>
				<div className="columns text-right">
					<a href={notification_url}>
						<i className="fa fa-envelope-open" aria-hidden="true"></i>
					</a>
				</div>
			</div>
		);
	}

	notificationUnread(notification_env, notification_status, notification_url) {

		return (
			<div className="row mark-unread">
				<div className="large-10 columns text-left">
					Environment: {notification_env} - {notification_status}
				</div>
				<div className="columns text-right">
					<a href={notification_url}>
						<i className="fa fa-envelope" aria-hidden="true"></i>
					</a>
				</div>
			</div>
		);
	}

	render() {
		let notification_data = JSON.parse(this.props.data);
		let notification_url = `/users/notifications/${this.state.id}/read`;
		let notification_env = notification_data.environment_id;
		let notification_status = notification_data.current_status;
		let read_at = this.state.read_at;
		let read_status = '';

		if(read_at) {
			read_status = this.notificationRead(notification_env, notification_status, notification_url);
		}
		else {
			read_status = this.notificationUnread(notification_env, notification_status, notification_url);
		}

		return (
			<div>
				{read_status}
			</div>
		);
	}
}

export default ResultItem;