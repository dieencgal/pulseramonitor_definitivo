<div class="col-md-8 col-md-offset-2">

    <table class="table table-hover table-bordered table-striped">
        <thead>
        <tr>
            <th>Voted by 0 People </th>
            <th>{{$show->title}}</th>
            <th>Question ID: {{$show->id}}</th>
        </tr>
        <tr>
            <th>Check</th>
            <th>Answer</th>
            <th>ID</th>
        </tr>
        </thead>
        <tbody>
        @foreach($show->survey_questions as $ans)
            <tr>
                <td><input type="radio" name="check[]"></td>
                <td>{{$ans['answer']}}</td>
                <td>{{$ans['id']}}:</td>
                <a name="vote{{$ans->id}}" href="{{action('EncuestaController')}}"   class="btn btn-primary">Vote</a>
            </tr>
        @endforeach
        </tbody>
    </table>

</div>
