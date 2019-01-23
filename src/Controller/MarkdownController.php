<?php
/**
 *
 * @Author: bthrower
 * @CreateAt: 1/8/2019 5:16 PM
 * Project: EncounterTheCross
 * File Name: MarkdownController.php
 */

namespace App\Controller;

use App\Repository\MarkdownRepository;
use Doctrine\Common\Persistence\ObjectManager;
use http\Exception\InvalidArgumentException;
use Psr\SimpleCache\CacheInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class MarkdownController extends BaseController
{
    /**
     * @Route("/admin/markdown/edit/{name}", name="about_edit")
     * @param MarkdownRepository $markdownRepository
     * @param CacheInterface $cache
     * @param string $name
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws \Psr\SimpleCache\InvalidArgumentException
     */
    public function editMarkdown(MarkdownRepository $markdownRepository,CacheInterface $cache, string $name)
    {
        $testHTML = $cache->get($name);
        $markdown = $markdownRepository->findOneBy(['name' => $name]);
        return $this->render('about/edit_about_us.html.twig', [
            'markdown' => $markdown,
            'html'=>$testHTML
        ]);
    }

    /**
     * @Route("/markdown/save/{id}",name="save_markdown")
     * @param MarkdownRepository $markdownRepository
     * @param ObjectManager $manager
     * @param CacheInterface $cache
     * @param Request $request
     * @param $id
     * @return JsonResponse
     * @throws \Psr\SimpleCache\InvalidArgumentException
     */
    public function saveMarkdown(MarkdownRepository $markdownRepository, ObjectManager $manager, CacheInterface $cache, Request $request, $id)
    {
        $status = 200;
        $data = [];
        try {
            //Check for correct route/markdown object
            $markdown = $markdownRepository->findOneByID($id);
            if (!$markdown) {
                throw new InvalidArgumentException("That markdown object does not exist.");
            }
            //Check that markdown was supplied
            $md = $request->get('md');
            if (!$md) {
                throw new InvalidArgumentException("No Markdown supplied");
            }
            //Check that html was supplied
            $html = $request->get('html');
            if (!$html) {
                throw new InvalidArgumentException("No html supplied");
            }

            //Save the markdown to the database
            $markdown->setMarkdown($md);
            $manager->persist($markdown);
            $manager->flush();

            //Save the HTML to the cache!
            // save a new item in the cache

            $cacheName = $markdown->getName();

            try{
                $cache->set($cacheName, $html);
            }
            catch (\Psr\SimpleCache\InvalidArgumentException $e) {
                $data[] = $e;
            }

        } catch (\InvalidArgumentException $exception) {
            $data[] = $exception;
            $status = 404;
        }

        return new JsonResponse($data, $status);
    }
}
