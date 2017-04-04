<?php

namespace Victoire\DevTools\VacuumBundle\Pipeline\WordPress;

use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Helper\QuestionHelper;
use Symfony\Component\Console\Output\OutputInterface;
use Victoire\Bundle\BlogBundle\Entity\Blog;
use Victoire\Bundle\MediaBundle\Entity\Folder;
use Victoire\Bundle\WidgetMapBundle\Entity\WidgetMap;
use Victoire\DevTools\VacuumBundle\Pipeline\PlayloadInterface;

/**
 * Class WordPressPlayload
 * @package Victoire\DevTools\VacuumBundle\Pipeline\WordPress
 */
class WordPressPlayload implements PlayloadInterface
{
    /**
     * @var array
     */
    private $parameters = [];

    /**
     * @var OutputInterface
     */
    private $output;

    /**
     * @var QuestionHelper
     */
    private $questionHelper;

    /**
     * @var \SimpleXMLElement
     */
    private $rawData;

    /**
     * @var Blog
     */
    private $newBlog;

    /**
     * @var Folder
     */
    private $blogFolder;

    /**
     * @var WidgetMap
     */
    private $contentWidgetMap;

    /**
     * @var string
     */
    private $locale;

    /**
     * @var string
     */
    private $title;

    /**
     * @var string
     */
    private $link;

    /**
     * @var string
     */
    private $description;

    /**
     * @var \DateTime
     */
    private $publicationDate;

    /**
     * @var string
     */
    private $language;

    /**
     * @var string
     */
    private $baseSiteUrl;

    /**
     * @var string
     */
    private $baseBlogUrl;

    /**
     * @var array
     */
    private $authors = [];

    /**
     * @var array
     */
    private $categories = [];

    /**
     * @var array
     */
    private $tags = [];

    /**
     * @var array
     */
    private $items = [];

    /**
     * @var array
     */
    private $terms = [];

    /**
     * @var array
     */
    private $seos = [];

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
    )
    {
        $this->parameters = $parameters;
        $this->questionHelper = $questionHelper;
        $this->output = $output;
        $this->rawData = $rawData;
    }

    /**
     * @return array
     */
    public function getParameters()
    {
        return $this->parameters;
    }

    /**
     * @param string $key
     * @return mixed
     */
    public function getParameter($key)
    {
        return $this->parameters[$key];
    }

    /**
     * @param array $parameters
     * @return WordPressPlayload
     */
    public function setParameters(array $parameters)
    {
        $this->parameters = $parameters;
        return $this;
    }

    /**
     * @return OutputInterface
     */
    public function getOutput()
    {
        return $this->output;
    }

    /**
     * @param OutputInterface $output
     * @return WordPressPlayload
     */
    public function setOutput(OutputInterface $output)
    {
        $this->output = $output;
        return $this;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string $title
     * @return WordPressPlayload
     */
    public function setTitle($title)
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @return string
     */
    public function getLink()
    {
        return $this->link;
    }

    /**
     * @param string $link
     * @return WordPressPlayload
     */
    public function setLink($link)
    {
        $this->link = $link;
        return $this;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     * @return WordPressPlayload
     */
    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getPublicationDate()
    {
        return $this->publicationDate;
    }

    /**
     * @param \DateTime $publicationDate
     * @return WordPressPlayload
     */
    public function setPublicationDate($publicationDate)
    {
        $this->publicationDate = $publicationDate;
        return $this;
    }

    /**
     * @return string
     */
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     * @param string $language
     * @return WordPressPlayload
     */
    public function setLanguage($language)
    {
        $this->language = $language;
        return $this;
    }

    /**
     * @return string
     */
    public function getBaseSiteUrl()
    {
        return $this->baseSiteUrl;
    }

    /**
     * @param string $baseSiteUrl
     * @return WordPressPlayload
     */
    public function setBaseSiteUrl($baseSiteUrl)
    {
        $this->baseSiteUrl = $baseSiteUrl;
        return $this;
    }

    /**
     * @return string
     */
    public function getBaseBlogUrl()
    {
        return $this->baseBlogUrl;
    }

    /**
     * @param string $baseBlogUrl
     * @return WordPressPlayload
     */
    public function setBaseBlogUrl($baseBlogUrl)
    {
        $this->baseBlogUrl = $baseBlogUrl;
        return $this;
    }

    /**
     * @param $author
     * @return $this
     */
    public function addAuthor($author)
    {
        array_push($this->authors, $author);
        return $this;
    }

    /**
     * @return array
     */
    public function getAuthors()
    {
        return $this->authors;
    }

    /**
     * @param $authorLogin
     * @return mixed
     */
    public function getAuthor($authorLogin)
    {
        foreach ($this->authors as $author) {
            if ($author->getUsername() == $authorLogin || $author->getEmail() == $authorLogin) {
                return $author;
            }
        }
    }

    /**
     * @param array $authors
     * @return WordPressPlayload
     */
    public function setAuthors(array $authors)
    {
        $this->authors = $authors;
        return $this;
    }

    /**
     * @param $category
     * @return $this
     */
    public function addCategory($category)
    {
        array_push($this->categories, $category);
        return $this;
    }

    /**
     * @return array
     */
    public function getCategories()
    {
        return $this->categories;
    }

    /**
     * @param array $categories
     * @return WordPressPlayload
     */
    public function setCategories(array $categories)
    {
        $this->categories = $categories;
        return $this;
    }

    /**
     * @param $tag
     * @return $this
     */
    public function addTag($tag)
    {
        array_push($this->tags, $tag);
        return $this;
    }

    /**
     * @return array
     */
    public function getTags()
    {
        return $this->tags;
    }

    /**
     * @param array $tags
     * @return WordPressPlayload
     */
    public function setTags(array $tags)
    {
        $this->tags = $tags;
        return $this;
    }

    /**
     * @param $item
     * @return $this
     */
    public function addItem($item)
    {
        array_push($this->items, $item);
        return $this;
    }

    /**
     * @return array
     */
    public function getItems()
    {
        return $this->items;
    }

    /**
     * @param array $items
     * @return WordPressPlayload
     */
    public function setItems(array $items)
    {
        $this->items = $items;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getRawData()
    {
        return $this->rawData;
    }

    /**
     * @param mixed $rawData
     * @return WordPressPlayload
     */
    public function setRawData(\SimpleXMLElement $rawData)
    {
        $this->rawData = $rawData;
        return $this;
    }

    /**
     * @param $term
     * @return $this
     */
    public function addTerm($term)
    {
        array_push($this->terms, $term);
        return $this;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getTerm($id)
    {
        foreach ($this->getTerms() as $term) {
            if ($id == $term->getTermId()) {
                return $term;
            }
        }
    }

    /**
     * @return array
     */
    public function getTerms()
    {
        return $this->terms;
    }

    /**
     * @param array $terms
     * @return WordPressPlayload
     */
    public function setTerms(array $terms)
    {
        $this->terms = $terms;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getNewBlog()
    {
        return $this->newBlog;
    }

    /**
     * @param mixed $newBlog
     * @return WordPressPlayload
     */
    public function setNewBlog($newBlog)
    {
        $this->newBlog = $newBlog;
        return $this;
    }

    /**
     * @return string
     */
    public function getLocale()
    {
        return $this->locale;
    }

    /**
     * @param string $locale
     * @return WordPressPlayload
     */
    public function setLocale($locale)
    {
        $this->locale = $locale;
        return $this;
    }

    /**
     * @return WidgetMap
     */
    public function getContentWidgetMap()
    {
        return $this->contentWidgetMap;
    }

    /**
     * @param WidgetMap $contentWidgetMap
     * @return WordPressPlayload
     */
    public function setContentWidgetMap(WidgetMap $contentWidgetMap)
    {
        $this->contentWidgetMap = $contentWidgetMap;
        return $this;
    }

    /**
     * @return Folder
     */
    public function getBlogFolder()
    {
        return $this->blogFolder;
    }

    /**
     * @param Folder $blogFolder
     * @return WordPressPlayload
     */
    public function setBlogFolder(Folder $blogFolder)
    {
        $this->blogFolder = $blogFolder;
        return $this;
    }

    /**
     * @return ProgressBar
     */
    public function getProgressBar($value = null)
    {
        if (null == $value) {
            return new ProgressBar($this->output);
        }
        return new ProgressBar($this->output, $value);
    }

    /**
     * @return QuestionHelper
     */
    public function getQuestionHelper()
    {
        return $this->questionHelper;
    }

    /**
     * @param QuestionHelper $questionHelper
     * @return PlayloadInterface
     */
    public function setQuestionHelper(QuestionHelper $questionHelper)
    {
        $this->questionHelper = $questionHelper;
        return $this;
    }


    public function getSuccess()
    {
        $this->output->writeln("<info>success</info>");
    }

    /**
     * @return array
     */
    public function getSeos()
    {
        return $this->seos;
    }

    /**
     * @param array $seos
     * @return WordPressPlayload
     */
    public function setSeos(array $seos)
    {
        $this->seos = $seos;
        return $this;
    }

    /**
     * @param $article
     * @param $seo
     * @return $this
     */
    public function addSeo($article, $seo)
    {
        array_push($this->seos, [$article => $seo]);
        return $this;
    }

    /**
     * @param $article
     * @return mixed
     */
    public function getSeo($article)
    {
        foreach ($this->seos as $seo) {
            if (array_key_exists($article, $seo)) {
                return $seo[$article];
            }
        }
    }
}