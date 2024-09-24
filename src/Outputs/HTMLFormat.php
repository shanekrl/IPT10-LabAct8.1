<?php

namespace App\Outputs;

use App\Outputs\ProfileFormatter;

class HTMLFormat implements ProfileFormatter
{
    private $response;

    public function setData($profile)
    {
        $output = "<h1>Profile of " . $profile->getFullName() . "</h1>";
        $output .= "<p>Email: " . $profile->getContactDetails()['email'] . "</p>";
        $output .= "<p>Phone: " . $profile->getContactDetails()['phone_number'] . "</p>";
        $output .= "<h2>Education</h2>";
        $output .= "<p>" . $profile->getEducation()['degree'] . " at " . $profile->getEducation()['university'] . "</p>";
        $output .= "<h2>Skills</h2>";
        $output .= "<p>" . implode(", ", $profile->getSkills()) . "</p>";
        $output .= "<h2>Experience</h2><ul>";

        foreach ($profile->getExperience() as $job) {
            $output .= "<li>" . $job['job_title'] . " at " . $job['company'] . " (" . $job['start_date'] . " to " . $job['end_date'] . ")</li>";
        }
        $output .= "</ul>";

        $output .= "<h2>Certifications</h2><ul>";
        foreach ($profile->getCertifications() as $cert) {
            $output .= "<li>" . $cert['name'] . " (Earned on: " . $cert['date_earned'] . ")</li>";
        }
        $output .= "</ul>";

        $output .= "<h2>Extracurricular Activities</h2><ul>";
        foreach ($profile->getExtracurricularActivities() as $acts) {
            $output .= "<li>" . $acts['role'] . " at " . $acts['organization'] . " (" . $acts['start_date'] . " to " . $acts['end_date'] . ") - " . $acts['description'] . "</li>";
        }
        $output .= "</ul>";
        
        $output .= "<h2>Languages</h2><ul>";
        foreach ($profile->getLanguages() as $lang) {
            $output .= "<li>" . $lang['language'] . " (" . $lang['proficiency'] . ")</li>";
        }
        $output .= "</ul>";

        $output .= "<h2>References</h2><ul>";
        foreach ($profile->getReferences() as $ref) {
            $output .= "<li>" . $ref['name'] . ", " . $ref['position'] . " at " . $ref['company'] . 
                    " (Email: " . $ref['email'] . ", Phone: " . $ref['phone_number'] . ")</li>";
        }
        $output .= "</ul>";
        $this->response = $output;
    }

    public function render()
    {
        return $this->response;
    }
}