<?php
require_once __DIR__ . '/../vendor/autoload.php';

use Google\Client;
use Google\Service\AnalyticsReporting;
use Google\Service\AnalyticsReporting\DateRange;
use Google\Service\AnalyticsReporting\Metric;
use Google\Service\AnalyticsReporting\Dimension;
use Google\Service\AnalyticsReporting\ReportRequest;
use Google\Service\AnalyticsReporting\GetReportsRequest;

function getGoogleAnalyticsData($viewId, $startDate, $endDate) {
    try {
        $analytics = initializeAnalytics();
        if (!$analytics) {
            throw new Exception('Failed to initialize Google Analytics');
        }

        $dateRange = new DateRange();
        $dateRange->setStartDate($startDate);
        $dateRange->setEndDate($endDate);

        $sessions = new Metric();
        $sessions->setExpression("ga:sessions");
        $sessions->setAlias("sessions");

        $date = new Dimension();
        $date->setName("ga:date");

        $request = new ReportRequest();
        $request->setViewId($viewId);
        $request->setDateRanges([$dateRange]); // Wrap $dateRange in an array
        $request->setMetrics([$sessions]);
        $request->setDimensions([$date]);

        $body = new GetReportsRequest();
        $body->setReportRequests([$request]);
        $response = $analytics->reports->batchGet($body);

        return $response;
    } catch (Exception $e) {
        error_log('Error fetching Google Analytics data: ' . $e->getMessage());
        return null;
    }
}

function initializeAnalytics() {
    try {
        $client = new Client();
        $client->setAuthConfig(__DIR__ . '/../credentials.json');
        $client->addScope(AnalyticsReporting::ANALYTICS_READONLY);
        
        return new AnalyticsReporting($client);
    } catch (Exception $e) {
        error_log('Failed to initialize Google Analytics: ' . $e->getMessage());
        return null;
    }
}
