@extends('layouts.admin.index')


@section('content')

    <div class="row expanded">
        <div class="large-12 columns">
            <div class="data-card">
                <div class="data-header">
                    Beef tacos
                </div>

                <div class="data-content">
                    Are the best tacos.
                </div>
            </div>

        </div>
    </div>

    <div class="row expanded">
        <div class="large-6 columns">
            <div class="data-card-small">
                <div class="data-header">
                    Swedish meatballs
                </div>
                <div class="data-content">
                    Are not actually made from a swedish chef.
                </div>
            </div>
        </div>

        <div class="large-3 columns">
            <div class="data-card-small">
                <div class="data-header">
                    I do however
                </div>
                <div class="data-content">
                    Really like cheetos.
                </div>
            </div>
        </div>

        <div class="large-3 columns">
            <div class="data-card-small">
                <div class="data-header">
                    Because it's not easy
                </div>
                <div class="data-content">
                    Being cheesy.
                </div>
            </div>
        </div>
    </div>


    <div class="row expanded">
        <div class="large-12 columns">
            <div class="data-table">
                <div class="data-table-header">
                    This is a table about food!
                </div>

                <div class="data-table-content">

                    <table class="unstriped">
                        <thead>
                        <tr>
                            <th width="200">Food</th>
                            <th>Comment</th>
                            <th width="150">Type</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>Tacos</td>
                            <td>Are a-amazing!</td>
                            <td>Mexican</td>
                        </tr>
                        <tr>
                            <td>Ravioli</td>
                            <td>Is also a-amazing!</td>
                            <td>Italian</td>
                        </tr>
                        <tr>
                            <td>Hamburger</td>
                            <td>Additionally a-amazing!</td>
                            <td>American</td>
                        </tr>
                        </tbody>
                    </table>

                </div>
            </div>

        </div>
    </div>

@stop