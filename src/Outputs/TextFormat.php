<?php

namespace App\Outputs;

use App\Outputs\ProfileFormatter;

class TextFormat implements ProfileFormatter
{
    private $response;

    public function setData($profile)
    {
        $output = "Full Name: " . $profile->getFullName() . PHP_EOL;
        $output .= "Email: " . $profile->getContactDetails()['email'] . PHP_EOL;
        $output .= "Phone: " . $profile->getContactDetails()['phone_number'] . PHP_EOL;
        $output .= "Address: " . implode(", ", $profile->getContactDetails()['address']) . PHP_EOL;
        $output .= "Education: " . $profile->getEducation()['degree'] . " at " . $profile->getEducation()['university'] . PHP_EOL;
        $output .= "Skills: " . implode(", ", $profile->getSkills()) . PHP_EOL;
        
        $output .= "Experience:\n";
        foreach ($profile->getExperience() as $job) {
            $output .= "- " . $job['job_title'] . " at " . $job['company'] . " (" . $job['start_date'] . " to " . $job['end_date'] . ")\n";

        }
        $output .= "Certifications:\n";
        foreach ($profile->getCertifications() as $cert) {
            $output .= "- " . $cert['name'] . " (earned on " . $cert['date_earned'] . ")\n";
        }

        $output .= "Extracurricular Activities:\n";
        foreach ($profile->getExtracurricularActivities() as $acts) {
            $output .= "- " . $acts['role'] . " at " . $acts['organization'] . " (" . $acts['start_date'] . " to " . $acts['end_date'] . "): " . $acts['description'] . PHP_EOL;
        }

        $output .= "Languages:\n";
        foreach ($profile->getLanguages() as $lang) {
            $output .= "- " . $lang['language'] . " (" . $lang['proficiency'] . ")\n";
        }

        $output .= "References:\n";
        foreach ($profile->getReferences() as $ref) {
            $output .= "- " . $ref['name'] . ", " . $ref['position'] . " at " . $ref['company'] . " (Email: " . $ref['email'] . ", Phone: " . $ref['phone_number'] . ")\n";
        }

        $this->response = $output;
    }

    public function render()
    {
        header('Content-Type: text');
        return $this->response;
    }
}