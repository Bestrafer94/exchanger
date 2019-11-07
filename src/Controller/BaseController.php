<?php

declare(strict_types=1);

namespace App\Controller;

use League\Tactician\CommandBus;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;

abstract class BaseController extends AbstractController
{
    /**
     * @var CommandBus
     */
    protected $commandBus;

    public function __construct(CommandBus $commandBus)
    {
        $this->commandBus = $commandBus;
    }

    /**
     * @param FormInterface $form
     * @param Request $request
     *
     * @return bool
     */
    protected function isFormValidAndSubmitted(FormInterface $form, Request $request): bool
    {
        $form->handleRequest($request);

        return $form->isSubmitted() && $form->isValid();
    }

    /**
     * @param FormInterface $form
     *
     * @return array
     */
    protected function getErrorsFromForm(FormInterface $form): array
    {
        $errors = [];

        foreach ($form->getErrors() as $error) {
            $errors[] = $error->getMessage();
        }

        foreach ($form->all() as $childForm) {
            if ($childForm instanceof FormInterface) {
                if ($childErrors = $this->getErrorsFromForm($childForm)) {
                    $errors[$childForm->getName()] = $childErrors;
                }
            }
        }

        return $errors;
    }
}
