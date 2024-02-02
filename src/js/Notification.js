$(document).ready(function() {
    // Attach click event to the notification button
    $('#notificationBtn').on('click', function() {
        // Toggle visibility of the notification dropdown
        $('#notificationDropdown').toggle();

        // Check if the dropdown is visible and load notifications if needed
        if ($('#notificationDropdown').is(':visible')) {
            loadNotifications();
        }
    });

    // Function to load notifications using AJAX
    function loadNotifications() {
        // Make an AJAX request to fetch notifications from the server
        $.ajax({
            url: '../models/getNotifications.php', // Replace with your PHP file to fetch notifications
            type: 'GET',
            dataType: 'json',
            success: function(data) {
                // Handle the received data and update the notification dropdown
                updateNotificationDropdown(data);
            },
            error: function(error) {
                console.log('Error fetching notifications: ', error);
            }
        });
    }

// Function to update the notification dropdown content
function updateNotificationDropdown(notifications) {
    const dropdownContent = $('#notificationDropdown');

    // Clear existing content
    dropdownContent.empty();

    // Check if there are notifications
    if (notifications.length > 0) {
        // Iterate through notifications and append to the dropdown
        notifications.forEach(function(notification) {
            let notificationItem = $('<div class="notification-item"></div>');

            // Add sender information
            let senderInfo = $('<span class="notification-sender">' + notification.FromUserName + ': ' + '</span>');
            notificationItem.append(senderInfo);

            // Add notification text
            notificationItem.append(notification.NotificationText);

            // Add remove button
            let removeButton = $('<button class="remove-notification">X</button>');
            removeButton.on('click', function() {
                // Handle the remove button click
                removeNotification(notification.NotificationID);
            });
            notificationItem.append(removeButton);

            dropdownContent.append(notificationItem);
        });
    } else {
        // If no notifications, display a message
        dropdownContent.append('<div class="notification-item">No new notifications</div>');
    }

    // Show the dropdown after updating content
    $('#notificationDropdown').show();
}

// Function to handle the remove button click
function removeNotification(notificationID) {
    // Implement the logic to remove the notification from the database
    // You may use AJAX to send a request to the server to delete the notification
    // Adjust this function based on your server-side implementation
    $.ajax({
        type: 'POST',
        url: '../models/remove_notification.php', // Add timestamp to prevent caching
        data: { notificationID: notificationID },
        success: function(response) {
            // Handle the success response
            displayToast('Notification removed successfully')
            console.log(notificationID + 'Notification removed successfully' + response)
        },
        error: function(error) {
            // Handle the error
            console.error('Error removing notification', error)
        }
    });
}

function displayToast(msg) {
    let toastBox = document.getElementById('toastBox')
    
    let toast = document.createElement('div')
    toast.classList.add('toast')

    let svgImage = document.createElement('img')
    svgImage.src = '../icon/check.svg'

    let message = document.createElement('p')
    message.innerHTML = msg


    toast.appendChild(svgImage)
    toast.appendChild(message)
    toastBox.appendChild(toast)

    setTimeout(() => {
        toast.remove()
    }, 5000)
}


});