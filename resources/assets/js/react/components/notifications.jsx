import React, {Component} from "react";
import ReactDOM from "react-dom";

export default class Notifications extends React.Component {


    render() {
        return (
            <div>
                Notifications
            </div>
        );
    }
}

ReactDOM.render(<Notifications />, document.getElementById("notifications"));