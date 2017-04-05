<?php

namespace Victoire\DevTools\VacuumBundle\Playload;

use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Helper\QuestionHelper;
use Symfony\Component\Console\Output\OutputInterface;
use Victoire\DevTools\VacuumBundle\Entity\WordPress\Blog;

/**
 * Interface PlayloadInterface
 * @package Victoire\DevTools\VacuumBundle\Pipeline
 */
interface CommandPlayloadInterface
{
    /**
     * WordPressPlayload constructor.
     * @param array $parameters
     * @param ProgressBar $progressBar
     * @param QuestionHelper $questionHelper
     */
    public function __construct(
        array $parameters,
        OutputInterface $output,
        QuestionHelper $questionHelper,
        \SimpleXMLElement $rawData
    );

    /**
     * @return array
     */
    public function getParameters();

    /**
     * @param $key string
     * @return mixed
     */
    public function getParameter($key);

    /**
     * @return CommandPlayloadInterface
     */
    public function setParameters(array $parameters);

    /**
     * @return QuestionHelper
     */
    public function getQuestionHelper();

    /**
     * @return CommandPlayloadInterface
     */
    public function setQuestionHelper(QuestionHelper $questionHelper);

    /**
     * @return \SimpleXMLElement
     */
    public function getRawData();

    /**
     * @return CommandPlayloadInterface
     */
    public function setRawData(\SimpleXMLElement $rawData);

    /**
     * @return OutputInterface
     */
    public function getOutput();

    /**
     * @return Blog
     */
    public function getTmpBlog();

    /**
     * @param Blog $blog
     * @return mixed
     */
    public function setTmpBlog(Blog $blog);

    /**
     * @return \Victoire\Bundle\BlogBundle\Entity\Blog
     */
    public function getNewVicBlog();

    /**
     * @param \Victoire\Bundle\BlogBundle\Entity\Blog $blog
     * @return mixed
     */
    public function setNewVicBlog(\Victoire\Bundle\BlogBundle\Entity\Blog $blog);

    /**
     * @param null $value
     * @return mixed
     */
    public function getNewProgressBar($value = null);

    /**
     * @param $message
     * @return mixed
     */
    public function getNewSuccessMessage($message);

    /**
     * @param $message
     * @return mixed
     */
    public function throwErrorAndStop($message);

    /**
     * @param $message
     * @return mixed
     */
    public function getNewStageTitleMessage($message);

    /**
     * @return mixed
     */
    public function jumpLine();
}