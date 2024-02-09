
        // Validate email format
        function validateEmail() {
            var emailInput = document.getElementById('email');
            var emailPattern = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;

            if (!emailPattern.test(emailInput.value)) {
                alert('Please enter a valid email address.');
                return false;
            }

            return true;
        }

        // Validate Member ID 
        function validateMemberID() {
            var memberIDInput = document.getElementById('member_id');
            var memberIDPattern = /^M[0-9]{3}$/;

            if (!memberIDPattern.test(memberIDInput.value)) {
                alert('Please enter a valid Member ID (e.g., M001).');
                return false;
            }

            return true;
        }

        function editMember(member_id, first_name, last_name, birthday, email) {
            // editing a member
            var encodedFirstName = encodeURIComponent(first_name);
            var encodedLastName = encodeURIComponent(last_name);
            var encodedBirthday = encodeURIComponent(birthday);
            var encodedEmail = encodeURIComponent(email);

            window.location.href = '1.php?edit_member_id=' + encodeURIComponent(member_id) +
                '&first_name=' + encodedFirstName +
                '&last_name=' + encodedLastName +
                '&birthday=' + encodedBirthday +
                '&email=' + encodedEmail;
        }

        function deleteMember(member_id) {
            //  deleting a member
            var confirmDelete = confirm('Are you sure you want to delete this member?');

            if (confirmDelete) {
                window.location.href = '1.php?delete_member_id=' + member_id;
            }
        }
       