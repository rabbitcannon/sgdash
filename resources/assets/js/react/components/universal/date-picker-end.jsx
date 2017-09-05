import React, {Component} from 'react';
import ReactDOM from 'react-dom';
import ReactDatePicker from 'react-datepicker';
import Moment from 'moment';

export default class DatePickerEnd extends React.Component {
    constructor() {
        super();

        this.state = {
            date: ''
            // date: Moment()
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
				id="creation-date-end"
				name="creation-date-end"
                selected={this.state.date}
                onChange={this.handleChange}
            />
        );
    }
}

ReactDOM.render(<DatePickerEnd />, document.getElementById("date-picker-end"));