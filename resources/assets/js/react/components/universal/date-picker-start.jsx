import React, {Component} from 'react';
import ReactDOM from 'react-dom';
import ReactDatePicker from 'react-datepicker';
// import Moment from 'moment';

class DatePickerStart extends React.Component {
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
				id="creation-date-start"
				name="creation-date-start"
				showMonthDropdown
				showYearDropdown
				selected={this.state.date}
				onChange={this.handleChange}
            />
        );
    }
}

export default DatePickerStart;