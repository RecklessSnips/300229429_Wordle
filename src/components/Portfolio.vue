<template>
  <div class="body">
    <div class="container">
      <div class="header">
        <div class="github">
          <h3>Portfolio</h3>
        </div>

        <div class="nav">
          <a class="nav-link" href="#intro"><h3>Home</h3></a>
          <a class="nav-link" href="#education"><h3>Education</h3></a>
          <a class="nav-link" href="#skill"><h3>Skills</h3></a>
          <a class="nav-link" href="#experience"><h3>Experience</h3></a>
          <a class="nav-link" href="#project"><h3>Project</h3></a>
        </div>
      </div>

      <div class="main">
        <div class="intro" id="intro">
          <div class="img">
            <img src="/images/IMG_1967.jpg" alt="Chenxuan Gao" width="580px" height="410px" />
          </div>

          <div class="introduction">
            <p style="font-weight: bold">
              <span class="highlight1">HELLO!</span>
            </p>
            <h1><span class="highlight2">MEET</span></h1>
            <h1><span class="highlight3">Chenxuan Gao</span></h1>
            <h3>A Computer Science student at University of Ottawa</h3>
            <h3>Also a backend dev with 4 month work experience</h3>
          </div>
        </div>
        <hr />

        <div class="intro" id="intro">
          <div class="img">
            <img src="/images/image3.jpg" alt="Ruoyu Liu" width="580px" height="670px" />
          </div>

          <div class="introduction">
            <p style="font-weight: bold">
              <span class="highlight1">HELLO!</span>
            </p>
            <h1><span class="highlight2">MEET</span></h1>
            <h1><span class="highlight3">Ruoyu Liu</span></h1>
            <h3>A Computer Science student at University of Ottawa</h3>
            <h3>Handled more than 5 programming languages</h3>
          </div>
        </div>

        <hr />
        <div class="education" id="education">
          <h1 class="edu-heading">Education</h1>
          <div class="chenxuan-edu">
            <h1>Chenxuan Gao</h1>
            <div class="edu-school">
              <div class="edu-card-1">
                <h2>2018-2021</h2>
                <h2>High School Student</h2>
                <h4>A.B Lucas High School</h4>
                <p>
                  I spent 1.5 years in A.B. Lucas. It was a builtful scholl, very close to Hamilton.
                  Ithas the best community center: YMCA.
                </p>
              </div>
              <div class="edu-card-2">
                <h2>2021-2024</h2>
                <h2>University Student</h2>
                <h4>University of Ottawa</h4>
                <p>
                  I'm in my 3rd year in computer science major. The thing I like most about our
                  campus is the IBM lab room in SITE, it has several large DELL monitors in the
                  campus.
                </p>
                <p><strong>GPA: </strong>9.00</p>
                <ul>
                  <li>Merit Scholarship: 2021 Fall - 2023 Summer</li>
                  <li>Dean's Honour List Recipient (2021, 2022, 2023)</li>
                </ul>
              </div>
            </div>
          </div>

          <div class="ruoyu-edu">
            <h1>Ruoyu Liu</h1>
            <div class="edu-school">
              <div class="edu-card-1">
                <h2>2016-2019</h2>
                <h2>High School Student</h2>
                <h4>FuDan high school</h4>
                <p>
                  I am an international student. My high school was in China. It was a high-quality
                  school.
                </p>
              </div>
              <div class="edu-card-2 edu-liu">
                <h2>2021-2024</h2>
                <h2>University Student</h2>
                <h4>University of Ottawa</h4>
                <p>
                  I am a student in University of Ottawa. My major is Computer Science. This is my
                  third year in university. I have learned a lot with different professors.
                </p>
              </div>
            </div>
          </div>
        </div>
        <hr />
        <div class="skill" id="skill">
          <h1 class="skill-heading">Skills</h1>
          <div class="skill-card">
            <div class="skill-card-1">
              <div class="chenxuan-skill">
                <h1>Chenxuan Gao</h1>

                <div class="skills-matching">
                  <div class="skill-name">
                    <p>Programming Languages:</p>
                    <p>Web Development:</p>
                    <p>API:</p>
                    <p>Frontend Framework:</p>
                    <p>Backend Framework:</p>
                    <p>CICD:</p>
                    <p>DBMS:</p>
                    <p>Other Tools:</p>
                  </div>
                  <div class="skills">
                    <p>Java, Python, C#, Golang, Prolog, Scheme</p>
                    <p>HTML, CSS, Typescript</p>
                    <p>Fetch API, RESTful API</p>
                    <p>Bootstrap, Vue3</p>
                    <p>Spring Boot</p>
                    <p>GitHub Actions</p>
                    <p>MySQL</p>
                    <p>Docker, Postman</p>
                  </div>
                </div>
              </div>
            </div>

            <div class="skill-card-2">
              <div class="ruoyu-skill">
                <h1>Ruoyu Liu</h1>

                <div class="skills-matching">
                  <div class="skill-name">
                    <p>Programming Languages:</p>
                    <p>Web Development:</p>
                    <p>Frontend Framework:</p>
                    <p>CICD:</p>
                    <p>DBMS:</p>
                  </div>
                  <div class="skills">
                    <p>Java, C++, Golang, Prolog, Scheme</p>
                    <p>HTML, CSS, Javascript</p>
                    <p>Bootstrap, React</p>
                    <p>GitHub Actions</p>
                    <p>MySQL, PostgreSQL</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <hr />

        <div class="experience" id="experience">
          <h1 class="experience-heading">Experience</h1>
          <div class="ruoyu-exp">
            <h1>Ruoyu Liu</h1>
            <div class="exp-cards">
              <div class="card-1">
                <img src="/images/exp1.jpg" alt="experience1" width="500px" height="400px" />
                <div class="card-content">
                  <p>June 1, 2019 - August 25, 2019</p>
                  <h1 class="exp-heading">JBL Intern</h1>
                  <ul>
                    <li>
                      <h3>Analyze and compare the data of the earphone speaker unit</h3>
                    </li>
                    <li><h3>Write public account tweets</h3></li>
                  </ul>
                </div>
              </div>
              <div class="card-2">
                <img src="/images/exp2.jpg" alt="experience2" width="500px" height="400px" />
                <div class="card-content">
                  <p>June 10, 2023 - July 23, 2023</p>
                  <h1 class="exp-heading">Visteon Intern</h1>
                  <ul>
                    <li>
                      <h3>Anaylse the hardware of Automobile elements manufacturing</h3>
                    </li>
                    <li><h3>Welded circuit elements</h3></li>
                    <li><h3>Analyse data</h3></li>
                  </ul>
                </div>
              </div>
            </div>
          </div>

          <div class="chenxuan-exp">
            <h1>Chenxuan Gao</h1>
            <div class="exp-cards">
              <div class="card-1">
                <img src="/images/image4.jpeg" alt="experience1" width="500px" height="400px" />
                <div class="card-content">
                  <p>June 1, 2020 - August 28, 2020</p>
                  <h1>
                    <a
                      href="https://www.bolermountain.com/web-bookings/"
                      class="exp-link"
                      target="_blank"
                      >Boler Mountain Resort Attendant</a
                    >
                  </h1>
                  <ul>
                    <li>
                      <h3>Illustrate how treetop adventaure works with rope to tourists</h3>
                    </li>
                    <li>
                      <h3>Help other staff to collect and orgnaize tickets</h3>
                    </li>
                    <li>
                      <h3>Provide refreshment service for the padio events in the nights</h3>
                    </li>
                  </ul>
                </div>
              </div>
              <div class="card-2">
                <img src="/images/image5.jpeg" alt="experience2" width="550px" height="400px" />
                <div class="card-content">
                  <p>Jan 1, 2024 - Apr 27, 2024</p>
                  <h1>
                    <a href="https://solace.com/" class="exp-link" target="_blank">Solace Intern</a>
                  </h1>
                  <ul>
                    <li>
                      <h3>Configure GitHub workflows to automate workflow for company's library</h3>
                    </li>
                    <li>
                      <h3>Integrating Dependabot into all GitHub to upgrading vulnerabilities</h3>
                    </li>
                    <li>
                      <h3>Improving API documentation, fixing API endpoint errors</h3>
                    </li>
                    <li>
                      <h3>Solving various bugs in spectral-lint, editorials in the microserves</h3>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>

        <hr />

        <div class="project" id="project">
          <h1 class="project-heading">Project</h1>
          <div class="project-content">
            <h1>
              <a
                href="https://github.com/RecklessSnips/Vue3-2023-Interview"
                class="project-link"
                target="_blank"
                >Trivia</a
              >
            </h1>

            <div class="project-header">
              <h1>Image</h1>
              <h1>Description</h1>
            </div>
            <div class="project-detail">
              <img
                src="/images/image6.png"
                alt="trivia"
                class="project-image"
                width="40%"
                height="30%"
              />
              <div class="project-description">
                <p>
                  This is a Trivia quiz game with 9 categories of questions. The player need to
                  choose a prefered category to start.
                </p>
                <p>
                  The game is composed of 3 phases: easy, medium, and hard. Each phase has 2
                  questions. Score will be added for each corrected question and will be deducted
                  otherwise. Each correct choice for easy, medium, and hard question worth: 2, 4, 6;
                  and each wrong choice are: 1, 2, 3, accordingly.
                </p>
                <p>
                  Player will have 3 life before the fail the game, if so, they have to restart and
                  choose the categories again. If the player finish all 6 questions, that is, 3
                  phases, the game ends with a congratulation page.
                </p>
                <p>Next sections will show a sample playthrough of this game.</p>
              </div>
            </div>
            <div class="project-detail">
              <img
                src="/images/image7.png"
                alt="trivia"
                class="project-image"
                width="40%"
                height="30%"
              />
              <div class="project-description">
                <p>Game starts.</p>
              </div>
            </div>
            <div class="project-detail">
              <img
                src="/images/image8.png"
                alt="trivia"
                class="project-image"
                width="670px"
                height="450px"
              />
              <div class="project-description">
                <p>
                  I've chose a wrong choice so my chances goes to 2. And the game difficulty goes to
                  medium.
                </p>
              </div>
            </div>
            <div class="project-detail">
              <img
                src="/images/image9.png"
                alt="trivia"
                class="project-image"
                width="40%"
                height="30%"
              />
              <div class="project-description">
                <p>A popup for end of the game.</p>
              </div>
            </div>
            <div class="project-detail">
              <img
                src="/images/image10.png"
                alt="trivia"
                class="project-image"
                width="40%"
                height="30%"
              />
              <div class="project-description">
                <p>
                  Finally, it will shows me my final score and which questions I failed. Of course a
                  restart button at the end.
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="footer">
      <div class="footer-header">
        <h1>Contact Us</h1>
        <h4>Make your development journey Eaiser</h4>
      </div>
      <div class="contact">
        <div class="gao-contact">
          <h1 class="contact-header">Chenxuan Gao</h1>
          <div class="contact-detail">
            <h2>Address: 800 King Edward Ave</h2>
            <h2>Email: cgao034@uottawa.ca</h2>
            <h2>
              GitHub:
              <a class="g-link" href="https://github.com/RecklessSnips" target="_blank"
                >https://github.com/RecklessSnips</a
              >
            </h2>
          </div>
        </div>
        <div class="liu-contact">
          <h1 class="contact-header">Ruoyu Liu</h1>
          <div class="contact-detail">
            <h2>Address: 800 King Edward Ave</h2>
            <h2>Email: rliu144@uottawa.ca</h2>
            <h2>
              GitHub:
              <a class="g-link" href="https://www.github.com/30017134Ruoyu/" target="_blank"
                >https://www.github.com/30017134Ruoyu/</a
              >
            </h2>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script lang="ts">
export default {
  name: 'Portfolio'
}
</script>

<style scoped>
.body {
  background: url('/images/thomas-unsplash.jpg') no-repeat center center fixed;
  margin: auto 0;
}

a {
  text-decoration: none;
  color: azure;
}

hr {
  background-color: black;
  height: 1px;
  border: none;
}

.container {
  margin-left: 120px;
  margin-right: 80px;
}

.header {
  background-color: rgb(225, 225, 225, 0.1);
  width: 100%;
  position: sticky;
  top: 0;
  margin-bottom: 50px;
  display: flex;
  justify-content: space-between;
}

.nav {
  display: flex;
}

.nav > a {
  margin-right: 20px;
}

.nav-link:hover {
  color: rgb(11, 51, 252);
}

.main {
  margin-top: 50px;
  margin-right: 20px;
  margin-bottom: 100px;
}

.intro {
  display: flex;
  justify-content: space-between;
}

.introduction {
  margin-left: 100px;
  display: flex;
  flex-direction: column;
  align-items: flex-start;
  justify-content: start;
}

.highlight1 {
  color: gold;
}

.highlight2 {
  color: aqua;
}

.highlight3 {
  color: orange;
}

.edu-heading {
  text-align: center;
}

.edu-school {
  display: flex;
  justify-content: space-evenly;
}

.edu-card-1 {
  margin-right: 20px;
  padding-left: 30px;
}

.edu-card-2 {
  margin-left: 80px;
  padding-left: 30px;
}

.edu-liu {
  margin-left: 200px;
}

.skill-heading {
  text-align: center;
}
.skills-matching {
  display: flex;
  justify-content: flex-start;
}

.skill-name {
  font-weight: bold;
}

.skills {
  margin-left: 70px;
}

.skill-card {
  display: flex;
  flex-direction: row;
  justify-content: space-evenly;
}
.exp-cards {
  display: flex;
  flex-direction: row;
  justify-content: space-evenly;
}
.experience-heading {
  text-align: center;
}

.exp-link {
  color: rgb(47, 45, 45);
}

.exp-heading {
  color: gold;
}

.exp-link {
  color: gold;
}

.exp-link:hover {
  color: antiquewhite;
}

.project-heading {
  text-align: center;
}

.project-link {
  color: cyan;
}

.project-header {
  display: flex;
  justify-content: space-around;
}

.project-image {
  margin-left: 70px;
  margin-right: 30px;
}

.project-detail {
  display: flex;
  justify-content: space-start;
  margin-bottom: 50px;
}

.project-description {
  margin-left: 100px;
  font-size: 1.3rem;
}

.footer {
  border-top: 1px solid black;
  margin-bottom: 8px;
}

.footer-header {
  text-align: center;
}

.contact {
  display: flex;
  justify-content: space-evenly;
}

.contact-header {
  text-align: center;
}

.contact-detail {
  margin-left: 100px;
}

.g-link {
  color: black;
}

.g-link:hover {
  color: aqua;
}
</style>
