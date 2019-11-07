<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Transaction;
use App\Exception\ExchangeRatesNotFetchedException;
use App\Exception\SameCurrenciesException;
use App\Form\Data\TargetCurrencyChangeData;
use App\Form\Type\TargetCurrencyChangeType;
use App\Handler\Command\TargetCurrencyChangeCommand;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TargetCurrencyChangeController extends BaseController
{
    /**
     * @Route("/transaction/{id}", methods={"PATCH"},  name="target_currency_change")
     *
     * @param Request $request
     * @param int $id
     *
     * @return Response
     */
    public function changeCurrency(Request $request, int $id): Response
    {
        $form = $this->createForm(TargetCurrencyChangeType::class, new TargetCurrencyChangeData());

        if ($this->isFormValidAndSubmitted($form, $request)) {
            try {
                $command = new TargetCurrencyChangeCommand($form->getData(), $id);

                /** @var Transaction $transaction */
                $transaction = $this->commandBus->handle($command);
                $parameters = [
                    'transaction' => $transaction,
                    'statusCode' => Response::HTTP_CREATED,
                ];
            } catch (ExchangeRatesNotFetchedException $exception) {
                $parameters = [
                    'errorMessage' => $exception->getMessage(),
                    'statusCode' => Response::HTTP_FAILED_DEPENDENCY,
                ];
            } catch (SameCurrenciesException $exception) {
                $parameters = [
                    'errorMessage' => $exception->getMessage(),
                    'statusCode' => Response::HTTP_UNPROCESSABLE_ENTITY,
                ];
            }
        } else {
            $parameters = [
                'validationMessages' => $this->getErrorsFromForm($form),
                'statusCode' => Response::HTTP_BAD_REQUEST,
            ];
        }

        return $this->render(
            'transaction_created.html.twig',
            array_merge($parameters, ['action' => 'updated'])
        );
    }
}
