document.getElementById('comment-form').addEventListener('submit', function(event) {
    event.preventDefault();
    var commentInput = document.getElementById('comment');
    var commentText = commentInput.value;
    if (commentText.trim() !== '') {
        var commentList = document.getElementById('comment-list');
        var newComment = document.createElement('li');
        newComment.className = 'comment';
        newComment.innerHTML = '<p>' + commentText + '</p>';
        commentList.appendChild(newComment);
        commentInput.value = '';
    }
});
