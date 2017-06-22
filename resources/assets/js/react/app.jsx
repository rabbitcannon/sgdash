import "babel-polyfill";
import React, {Component} from "react";

import Notifications from "./components/notifications/index.jsx";

class App extends React.Component {


    render() {
        return (
            <Notifications />
        );
    }
}

export default App;