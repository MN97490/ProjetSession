<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Conversation avec {{ $conversation->getOtherUserName() }}</title>
    <!-- Liens vers les styles Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h1>Conversation avec {{ $conversation->getOtherUserName() }}</h1>

        <ul id="messagesList" class="list-group">
            @foreach ($messages as $message)
                <li class="list-group-item"><strong>{{ $message->getSenderName() }}:</strong> {{ $message->texte }}</li>
            @endforeach
        </ul>

       
        <form id="messageForm" action="{{ route('messages.store') }}" method="POST">
            @csrf
            <div class="form-group mt-3">
                <label for="texte">Nouveau message :</label>
                <textarea class="form-control" id="texte" name="texte" rows="3"></textarea>
            </div>
            <input type="hidden" name="conversation_id" value="{{ $conversation->id }}">
            <button type="submit" class="btn btn-primary">Envoyer</button>
        </form>
    </div>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
      $(document).ready(function () {
        
    $('#messageForm').submit(function (e) {
        e.preventDefault(); 


        var formData = $(this).serialize();

      
        $.ajax({
            url: $(this).attr('action'),
            type: 'POST',
            data: formData,
            success: function (response) {
              
                var newMessage = response.message;
                var senderName = response.sender_name; 
                $('#messagesList').append('<li class="list-group-item"><strong>' + senderName + ':</strong> ' + newMessage.texte + '</li>');

               
                $('#texte').val('');
            },
            error: function (xhr) {
               
                console.error(xhr);
            }
        });
    });
});

    </script>
</body>
</html>
