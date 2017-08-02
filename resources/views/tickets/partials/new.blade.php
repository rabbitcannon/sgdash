<div class="data-card-small">
    <div class="data-header">
        Add a new ticket
    </div>

    <div class="data-content">

        <form action="/tickets/create" class="no-smoothState">

            <div class="row">
                <div class="large-12 columns">
                    <label>Project Code
                        @if($errors->has('subject'))
                            {!!  $errors->first('subject', '<small><span class="failure-text is-visible">:message</span></small>') !!}
                        @endif
                        <input type="text" name="subject" placeholder="Subject" value="{{ old('subject') }}">
                    </label>
                </div>
            </div>

            <div class="row">
                <div class="large-12 columns">
                    <label>Project Name
                        @if($errors->has('description'))
                            {!!  $errors->first('description', '<small><span class="failure-text is-visible">:message</span></small>') !!}
                        @endif
                        <textarea rows="4" cols="50" name="description" placeholder="What's happening?" value="{{ old('description') }}"></textarea>
                    </label>
                </div>
            </div>



            <div class="row">
                <div class="large-12 columns text-center pad-box">
                    <button type="submit" class="button">
                        <i class="fa fa-save" aria-hidden="true"></i> Save Ticket
                    </button>

                    <button type="reset" class="button cancel-button">
                        <i class="fa fa-times" aria-hidden="true"></i> Clear Form
                    </button>
                </div>
            </div>

            @if($errors->any())
                <script>
                    $(document).ready(function() {
                        $('#add-ticket-reveal').foundation('toggle');
                    });
                </script>
            @endif

        </form>

    </div>
</div>


