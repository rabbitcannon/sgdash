import React, {Component} from 'react';
import Axios from 'axios';

import ResultItem from './result-item.jsx';

class Results extends React.Component {
	constructor() {
		super();

		this.state = {
			count: null,
			notifications: []
		}
	}

	componentDidMount() {
		var url = '/api/v1/users/notifications/' + $('#notifications').attr('data-user');
		this.getNotifications(url);
    }

	getNotifications(url) {
		$('#notify-container').append("<img id='notification-loader' src='/images/preloaders/preloader_mini.svg'>");

		var self = this;
		Axios.get(url).then(function(response) {
			self.setState({
				count: response.data.length,
				notifications: response.data
			});

			$('#notification-loader').fadeOut(250);
		}.bind(this)).catch(function(error) {
			console.log(error);
		});
	}


	renderWithNotifications() {
		let resultItems = this.state.notifications.map(function(notification, i) {
			return <ResultItem ref="results" key={notification.id} id={notification.id} data={notification.data} read_at={notification.read_at}  />
		});

		return (
			<div id="notify-container">
				<span className="badge red-badge">
					{this.state.count}
				</span>
				<i className="fa fa-bell" aria-hidden="true"></i>

				<div className="notifications__items">
					<div className="dialogue-arrow"></div>
					<div className="data-card-flyout">
						<div className="data-header">
							Notifications
						</div>
						<div className="data-content">
							{resultItems}
						</div>
						<a href="/notifications/all">
							<div className="data-footer">
								All Notifications
							</div>
						</a>
					</div>
				</div>
			</div>
		);
	}

	renderWithoutNotifications() {
		return (
			<div id="notify-container">
				<i className="fa fa-bell-slash" aria-hidden="true"></i>
				<div className="notifications__items">
					<div className="dialogue-arrow"></div>
					<div className="data-card-flyout">
						<div className="data-header">
							Notifications
						</div>
						<div className="data-content text-center">
							No notifications at this time.
						</div>
					</div>
				</div>
			</div>
		);
	}

	render() {
		if(this.state.count > 0) {
			return this.renderWithNotifications();
		}
		else {
			return this.renderWithoutNotifications();
		}
    }
}

export default Results;