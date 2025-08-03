# WAPH Team Project – Sprint 0 Submission

**Team Number**: 12  
**Sprint 0 Date**: July 29, 2025  
**Project Topic**: Sprint 0

---

## Team Members

| Name               | Role                    | GitHub Username     | Personal Homepage Link                                      |
|--------------------|-------------------------|----------------------|--------------------------------------------------------------|
| Anvitha Battineni  | Team Lead, Frontend Dev | battinenia1          | [Project 1 Homepage](https://battinenia1.github.io/) |
| Neeraj Akhnoor     | Backend Developer        | akhnoorn1            | [Project 1 Homepage](https://akhnoorn1.github.io)   |
| Ryan Cheng         | Security Analyst         | 4chengr              | [Project 1 Homepage](https://4chengr.github.io)     |

---

## Completed Sprint 0 Tasks

- Configured Apache for HTTPS with domain: `https://waph-team12.minifacebook.com`
-  Configured `/etc/hosts` for local domain mapping
-  Designed and imported team MySQL database with `team12` user
-  Copied and revised Lab 3 code:
  - Integrated Lab 4 security updates
  - Database-connected login using `checklogin_mysql()`
-  Created index.html with team member details and Project 1 links
-  All pages hosted and accessible via HTTPS local domain

---

## Screenshots

### Login System Working (on HTTPS domain)
![Login Page Anvitha](Anvitha_login_page.png)
![Login Page Neeraj](Neeraj_login_page.png)
![Login Page Ryan](Ryan_login_page.jpg)

### Index Page on Team Domain
![Team Index Page](team_index_page.png)
![Ryan Team Index Page](index-local-ryan.jpg)
---

## Sprint 0 Contribution Summary

- **Anvitha Battineni** (Team Lead, Frontend Developer):  
  Set up team repositories, generated and configured SSL keys, implemented the HTTPS setup, and designed the `index.html` page. Coordinated all commits and finalized the login system integration.Helped test the HTTPS login flow and provided supporting screenshots.

- **Neeraj Akhnoor** (Backend Developer):  
  Created the MySQL database and user, wrote SQL scripts for schema and data, and tested PHP-MySQL login connectivity.Configured Apache for HTTPS, validated SSL placement, and reviewed the PHP login code for security. 

- **Ryan Cheng** (Security Analyst):
  Enhanced security by implementing secure session configuration, added a sample user to the database, improved the login form to include a real-time digital clock functionality and server-side timestamp display, enhanced the team's basic form by adding HTML structure, JS timing features, etc. 
  

---


# WAPH Team Project – Sprint 1 Submission

**Team Number**: 12  
**Sprint 0 Date**: August 3, 2025  
**Project Topic**: Sprint 1

Duration 07/30/2025 - 08/03/2025

Complected Tasks:

  - Created MySQL table schema for users and posts. Sample data was also inserted in the database.
  - Wrote secure user registration form with validation (registration.php).
  - Built login system with session authentication for logged-in users (session_auth.php).
  - Allowed users to change their password (changepassword.php, changepasswordform.php).
  - User can now edit their profile: name, email, and phone (editprofile.php and editprofilesuccess.php).
  - Created view posts for the logged in user (view_posts.php).
  - Structured frontend with links to all features from index.php and index.html.
  - Wrote SQL scripts to create team database (database-account.sql and database-data.sql).
  - Uploaded screenshots that show the functional pages (login, profile, registration, posts).
  - Checked host and database are working with HTTPS on Apache web server.

Contribution:

- **Anvitha Battineni** (Team Lead, Frontend Developer):  
      Member 1 – 🟩 7 commits, ⏱️ 10 hours
        - Took lead on all the major technical development tasks, including:
        - MySQL database and schema
        - Registration and login
        - Edit profile
        - View posts
        - SQL scripts and server-side PHP integration

- **Neeraj Akhnoor** (Backend Developer): 
      (Member 2) – 🟨 3 commits, ⏱️ 5 hours
        - Contributed to testing and project management and was partially responsible for backend development on a few specific tasks:
        - Took screenshots and documented page functionality
        - Also manually tested the flows on multiple users
        - Implemented changepasswordform.php and changepassword.php
        - Verified visual and backend integration on the password update"

Sprint Retrospection:

  What went well:

    The team worked well together and balanced the technical/non-technical division of work.

    The team managed to complete tasks by the deadline and implement the main aspects of the projects (login, registration, edit profile, etc.)

    The secure database access and PHP integration was fairly smooth.

    Neeraj helped facilitate the testing and contributed screenshots for documentation which was beneficial in validating the completed sprint work.

    The change password functionality was developed collaboratively and pass the tests as defined by manual testing.

  Challenges faced:

    Some lost time early in the sprint with file organization not being clear and inconsistent form naming conventions.

    The change password logic required testing in a back-and-forth fashion because of session management concerns.

    There was some coordination involved with the technical and non-technical work streams being separate, we needed to have more sync meetings.

    There were variable commmit frequency (some members were pushing commits more often) which made it slightly harder to assess shared progress in real-time.

  Ideas for improvements for the next sprint:

    Schedule a short team-sync during the sprint to provide visibility and communication.

    Implement using standard file naming conventions and file-PHP routing as early as possible in the sprint.

    Encouraging all members to push more frequent commits would help in portions of code reviews and help to minimize merge issues.

    It would also be beneficial to start the UI layout design drafts early and break into smaller deliverables to distribute workload.