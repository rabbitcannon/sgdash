import React, {Component} from "react";
import ReactDOM from "react-dom";

import Results from './components/results.jsx';

export default class Notifications extends React.Component {

    render() {
        return (
            <Results />
        );
    }
}

ReactDOM.render(<Notifications />, document.getElementById("notifications"));