<?php
include '../db.php'; // Database connection
include 'navbar.php';

$course = null;
$feedbackResult = null;

// Fetch course details
if (isset($_GET['course_id'])) {
    $course_id = intval($_GET['course_id']);

    // Query to fetch course details
    $courseQuery = "SELECT title, description FROM courses WHERE course_id = $course_id";
    $courseResult = mysqli_query($conn, $courseQuery);

    if ($courseResult && mysqli_num_rows($courseResult) > 0) {
        $course = mysqli_fetch_assoc($courseResult);
    } else {
        echo "<p class='text-danger'>Course not found.</p>";
    }

    // Query to fetch feedback for the selected course along with replies
    $feedbackQuery = "
        SELECT 
            f.feedback_id,
            f.feedback_text, 
            f.rating, 
            u.username AS student_name, 
            f.reply_text 
        FROM 
            feedback f
        JOIN 
            users u ON f.student_id = u.user_id
        WHERE 
            f.course_id = $course_id
    ";
    $feedbackResult = mysqli_query($conn, $feedbackQuery);
}

// Handle reply submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['feedback_id'], $_POST['reply_text'])) {
    $feedback_id = intval($_POST['feedback_id']);
    $reply_text = mysqli_real_escape_string($conn, $_POST['reply_text']);

    $updateQuery = "UPDATE feedback SET reply_text = '$reply_text' WHERE feedback_id = $feedback_id";
    if (mysqli_query($conn, $updateQuery)) {
        echo "<script>alert('Reply submitted successfully.');</script>";
    } else {
        echo "<script>alert('Error submitting reply.');</script>";
    }

    // Refresh the page to show updated data
    header("Location: viewfeedback.php?course_id=$course_id");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkm6Yc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <style>
        body {
            background-color: rgb(207, 238, 236);
        }
        .table {
            color: rgb(38, 204, 226);
        }
        th {
            color: rgb(38, 204, 226);
            margin: 10px;
            border: 1px solid #000;
            background-color: skyblue; /* Added background color */
        }
        .reply-box {
            display: none;
            margin-top: 10px;
        }
        .colour{
            margin-top: 100px;
        }
    </style>
</head>
<body>
    <div class="colour">
    <div class="container my-5">
        <h2>Feedback for <?php echo htmlspecialchars($course['title'] ?? 'Unknown Course'); ?></h2>
        <p><?php echo htmlspecialchars($course['description'] ?? 'No description available.'); ?></p>
        </div>
        <table class="table table-striped">
            <thead class="table-black">
                <tr>
                    <th>Student Name</th>
                    <th>Feedback</th>
                    <th>Rating</th>
                    <th>Reply</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($feedbackResult && mysqli_num_rows($feedbackResult) > 0): ?>
                    <?php while ($feedback = mysqli_fetch_assoc($feedbackResult)): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($feedback['student_name']); ?></td>
                            <td><?php echo htmlspecialchars($feedback['feedback_text']); ?></td>
                            <td><?php echo htmlspecialchars($feedback['rating']); ?></td>
                            <td>
                                <?php echo htmlspecialchars($feedback['reply_text'] ?? 'No reply yet.'); ?>
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <button class="btn btn-primary me-2" onclick="showReplyBox(<?php echo $feedback['feedback_id']; ?>)">Reply</button>
                                </div>
                                <div id="replyBox-<?php echo $feedback['feedback_id']; ?>" class="reply-box">
                                    <form method="post">
                                        <textarea name="reply_text" class="form-control" rows="3" placeholder="Write your reply..." required></textarea>
                                        <input type="hidden" name="feedback_id" value="<?php echo $feedback['feedback_id']; ?>">
                                        <div class="d-flex justify-content-end mt-2">
                                            <button type="submit" class="btn btn-success me-2">Submit Reply</button>
                                            <button type="button" class="btn btn-secondary" onclick="hideReplyBox(<?php echo $feedback['feedback_id']; ?>)">Cancel</button>
                                        </div>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5">No feedback available for this course.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    <script>
        function showReplyBox(feedbackId) {
            document.getElementById('replyBox-' + feedbackId).style.display = 'block';
        }

        function hideReplyBox(feedbackId) {
            document.getElementById('replyBox-' + feedbackId).style.display = 'none';
        }
    </script>
</body>
</html>
