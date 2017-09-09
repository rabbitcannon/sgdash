import "babel-polyfill";
import React, {Component} from "react";
import $ from 'jquery';

import Notifications from "./components/notifications/index.jsx";
import DatePickerStart from './components/universal/date-picker-start.jsx';
import DatePickerEnd from './components/universal/date-picker-end.jsx';

class App extends React.Component {
	componentDidMount() {
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});
	}

    render() {
        return (
            <div>
                <Notifications />
                <DatePickerStart />
                <DatePickerEnd />
            </div>
        );
    }
}

export default App;