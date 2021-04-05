<?php

namespace App\Controller;

use App\Service\TextService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MarkdownFormController extends AbstractController
{
    /**
     * @Route("/", name="markdown_form")
     */
    public function index(): Response
    {
        return $this->render('markdown_form/index.html.twig', []);
    }

    /**
     * @Route("/getpreview", name="markdown_preview", methods={"POST"})
     */
    public function getPreview(Request $request, TextService $textService): JsonResponse
    {
        $data = $request->toArray();
        $text = $data['text'] ?? '';

        return $this->json(['text' => $textService->markdownToHtml($text)]);
    }
}
