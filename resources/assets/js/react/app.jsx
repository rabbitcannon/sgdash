import "babel-polyfill";
import React, {Component} from "react";

import Notifications from "./components/notifications/index.jsx";
import DatePickerStart from './components/universal/date-picker-start.jsx';
import DatePickerEnd from './components/universal/date-picker-end.jsx';

class App extends React.Component {


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