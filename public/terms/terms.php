<?php
// public/terms/terms.php
if (isset($_POST['accept'])) {
    header("Location: ../r/redirect.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Staff Terms & Responsibilities</title>
    <link rel="stylesheet" href="../assets/css/termcss.css">
</head>
<body>
    <div class="terms-box">
        <h1>Staff Terms & Responsibilities – Femboy & Furry Palace</h1>
        <div class="terms-content">
            <p>Welcome to the staff application process for Femboy & Furry Palace. By applying, you agree to comply with all rules, responsibilities, and guidelines listed below. The server administration reserves the right to enforce sanctions, including removal from the team, if any term is violated.</p>

            <h2>1. Conduct & Behavior</h2>
            <ul>
                <li>Always maintain professional, respectful, and impartial behavior.</li>
                <li>Avoid unnecessary arguments with members or other staff.</li>
                <li>Do not use staff powers to favor friends or punish members unfairly.</li>
                <li>Do not share internal staff information or server details in external channels.</li>
            </ul>

            <h2>2. Confidentiality & Privacy</h2>
            <ul>
                <li>All information obtained as staff is strictly confidential.</li>
                <li>Private messages, moderation logs, reports, or sensitive data must not be shared outside the server.</li>
                <li>Leaking confidential information may result in immediate removal from staff and possible server ban.</li>
            </ul>

            <h2>3. Moderation & Responsibilities</h2>
            <ul>
                <li>Monitoring channels for inappropriate behavior, spam, harassment, or rule violations.</li>
                <li>Issuing warnings, mutes, or bans according to server protocols.</li>
                <li>Recording all moderation actions in logs or reports as instructed.</li>
                <li>Answering member questions politely and clearly.</li>
                <li>Participating in meetings and internal votes when required.</li>
                <li>⚠️ Never use staff powers outside your designated responsibilities or for personal gain.</li>
            </ul>

            <h2>4. Tools & Permissions</h2>
            <ul>
                <li>Only use bots, channels, and permissions assigned to your role.</li>
                <li>Do not attempt to exploit vulnerabilities, bugs, or permissions.</li>
                <li>Any misuse of tools, bots, or admin commands will be subject to sanctions.</li>
            </ul>

            <h2>5. Activity & Availability</h2>
            <ul>
                <li>Staff are expected to be active and present during designated hours.</li>
                <li>Notify administration in advance if you need to be absent.</li>
                <li>Inactive staff may be removed from the team without prior notice.</li>
            </ul>

            <h2>6. Interaction with Other Staff</h2>
            <ul>
                <li>Respect hierarchies and responsibilities within the team.</li>
                <li>Questions or disputes should be reported directly to administration, not handled independently.</li>
                <li>Avoid public debates about administrative decisions or member punishments.</li>
            </ul>

            <h2>7. Server Security</h2>
            <ul>
                <li>Do not share admin links, backups, bots, or tokens with anyone.</li>
                <li>Follow Discord security guidelines: do not click suspicious links and report hacks or attacks immediately.</li>
                <li>Collaborate with administration to maintain server safety.</li>
            </ul>

            <h2>8. Additional Staff Responsibilities (Discord To-Do)</h2>
            <ul>
                <li>Monitor text and voice channels continuously to maintain order.</li>
                <li>Review member reports and make fair decisions.</li>
                <li>Update moderation logs with actions taken.</li>
                <li>Assist with official events and activities in the server.</li>
                <li>Ensure new rules are enforced properly.</li>
                <li>Review and approve member-submitted links, invites, and content.</li>
                <li>Help integrate new members and answer questions.</li>
                <li>Report bugs, conflicts, or issues to administration.</li>
                <li>Follow the punishment escalation plan: warning → mute → temporary ban → permanent ban.</li>
            </ul>

            <h2>9. Acceptance of Terms</h2>
            <ul>
                <li>You have read and understood all terms above.</li>
                <li>You are aware of the responsibilities of being a staff member.</li>
                <li>You agree to follow the server rules and guidelines.</li>
                <li>You understand that violations may result in removal from staff and further penalties.</li>
            </ul>
        </div>
        <form method="POST">
            <button type="submit" name="accept" class="neon-btn">Accept & Continue</button>
        </form>
    </div>
</body>
</html>
