<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form inputs
    $name = $_POST['name'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    // Set up the recipient email (your Gmail address)
    $to = "your_email@gmail.com"; // Replace with your Gmail address

    // Set the email subject
    $email_subject = "Message from: " . $name . " - " . $subject;

    // Create the email content
    $email_body = "You have received a new message from the user $name.\n".
                  "Email: $email\n".
                  "Subject: $subject\n".
                  "Message:\n$message";

    // Set email headers
    $headers = "From: $email\n";
    $headers .= "Reply-To: $email\n";
    $headers .= "Content-type: text/plain; charset=UTF-8\n";

    // Send the email
    if (mail($to, $email_subject, $email_body, $headers)) {
        echo "<script>alert('Your message has been sent. Thank you!'); window.location.href='thankyou.html';</script>";
    } else {
        echo "<script>alert('Sorry, something went wrong. Please try again later.'); window.location.href='contact.html';</script>";
    }
}
?>






<script>
  document.querySelector("form").addEventListener("submit", function(event) {
    event.preventDefault(); // Prevents the form from submitting immediately

    var form = event.target;
    var formData = new FormData(form);
    
    fetch('send_email.php', {
      method: 'POST',
      body: formData
    })
    .then(response => response.text())
    .then(data => {
      // Show success message and hide the form
      document.querySelector('.sent-message').style.display = 'block';
      form.reset(); // Optional: Reset form fields after submission
    })
    .catch(error => {
      alert('Error: ' + error);
    });
  });
</script>
