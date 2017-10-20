import React, {Component} from "react";
import ReactDOM from "react-dom";
import ReactDatePicker from 'react-datepicker';

class ReqEta extends React.Component {
	constructor(props) {
		super(props);

		this.state = {
			selected_date: ''
		}
	}

	handleChange = (date) => {
		this.setState({
			selected_date: date
		})
	}

	render() {
		return (
			<ReactDatePicker
				name="req_eta"
				placeholderText="Date"
				showMonthDropdown
				showYearDropdown
				selected={this.state.selected_date}
				yearDropdownItemNumber={5}
				shouldCloseOnSelect={true}
				onChange={this.handleChange}
			/>
		);
	}
}

ReactDOM.render(<ReqEta/>, document.getElementById("add-req-eta"));