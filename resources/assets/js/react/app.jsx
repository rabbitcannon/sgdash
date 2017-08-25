import "babel-polyfill";
import React, {Component} from "react";

import Notifications from "./components/notifications/index.jsx";
import DatePicker from './components/universal/date-picker.jsx';

class App extends React.Component {


    render() {
        return (
            <div>
                <Notifications />
                <DatePicker />
            </div>
        );
    }
}

export default App;