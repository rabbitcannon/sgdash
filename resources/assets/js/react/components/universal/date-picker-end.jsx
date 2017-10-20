import React, {Component} from 'react';
import ReactDatePicker from 'react-datepicker';

class DatePickerEnd extends React.Component {
	constructor() {
		super();

		this.state = {
			date: ''
		}

		this.handleChange = this.handleChange.bind(this);
	}

	componentDidMount = () => {
		// $('#creation-date-end').css('width', '26em');
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
				className="creation-width"
				showMonthDropdown
				showYearDropdown
				placeholderText="Start Date"
				selected={this.state.date}
				onChange={this.handleChange}
			/>
		);
	}
}

export default DatePickerEnd;