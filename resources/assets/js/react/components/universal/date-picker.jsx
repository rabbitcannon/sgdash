import React, {Component} from 'react';
import ReactDOM from 'react-dom';
import ReactDatePicker from 'react-datepicker';
import Moment from 'moment';

export default class DatePicker extends React.Component {
    constructor() {
        super();

        this.state = {
            date: Moment()
        }

		this.handleChange = this.handleChange.bind(this);
    }

    handleChange(new_date) {
		this.setState({
			date: new_date
		});
    }

    render() {
        return (
            <ReactDatePicker
				id="creation-date"
                selected={this.state.date}
                onChange={this.handleChange}
            />
        );
    }
}

ReactDOM.render(<DatePicker />, document.getElementById("date-picker"));