<?php

namespace App\Test\Controller;

use App\Entity\PreRegistration;
use App\Repository\PreRegistrationRepository;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class PreRegistrationControllerTest extends WebTestCase
{
    private KernelBrowser $client;
    private PreRegistrationRepository $repository;
    private string $path = '/pre/registration/';

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->repository = static::getContainer()->get('doctrine')->getRepository(PreRegistration::class);

        foreach ($this->repository->findAll() as $object) {
            $this->repository->remove($object, true);
        }
    }

    public function testIndex(): void
    {
        $crawler = $this->client->request('GET', $this->path);

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('PreRegistration index');

        // Use the $crawler to perform additional assertions e.g.
        // self::assertSame('Some text on the page', $crawler->filter('.p')->first());
    }

    public function testNew(): void
    {
        $originalNumObjectsInRepository = count($this->repository->findAll());

        $this->markTestIncomplete();
        $this->client->request('GET', sprintf('%snew', $this->path));

        self::assertResponseStatusCodeSame(200);

        $this->client->submitForm('Save', [
            'pre_registration[createdAt]' => 'Testing',
            'pre_registration[status]' => 'Testing',
            'pre_registration[student]' => 'Testing',
            'pre_registration[folder]' => 'Testing',
        ]);

        self::assertResponseRedirects('/pre/registration/');

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));
    }

    public function testShow(): void
    {
        $this->markTestIncomplete();
        $fixture = new PreRegistration();
        $fixture->setCreatedAt('My Title');
        $fixture->setStatus('My Title');
        $fixture->setStudent('My Title');
        $fixture->setFolder('My Title');

        $this->repository->add($fixture, true);

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('PreRegistration');

        // Use assertions to check that the properties are properly displayed.
    }

    public function testEdit(): void
    {
        $this->markTestIncomplete();
        $fixture = new PreRegistration();
        $fixture->setCreatedAt('My Title');
        $fixture->setStatus('My Title');
        $fixture->setStudent('My Title');
        $fixture->setFolder('My Title');

        $this->repository->add($fixture, true);

        $this->client->request('GET', sprintf('%s%s/edit', $this->path, $fixture->getId()));

        $this->client->submitForm('Update', [
            'pre_registration[createdAt]' => 'Something New',
            'pre_registration[status]' => 'Something New',
            'pre_registration[student]' => 'Something New',
            'pre_registration[folder]' => 'Something New',
        ]);

        self::assertResponseRedirects('/pre/registration/');

        $fixture = $this->repository->findAll();

        self::assertSame('Something New', $fixture[0]->getCreatedAt());
        self::assertSame('Something New', $fixture[0]->getStatus());
        self::assertSame('Something New', $fixture[0]->getStudent());
        self::assertSame('Something New', $fixture[0]->getFolder());
    }

    public function testRemove(): void
    {
        $this->markTestIncomplete();

        $originalNumObjectsInRepository = count($this->repository->findAll());

        $fixture = new PreRegistration();
        $fixture->setCreatedAt('My Title');
        $fixture->setStatus('My Title');
        $fixture->setStudent('My Title');
        $fixture->setFolder('My Title');

        $this->repository->add($fixture, true);

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));
        $this->client->submitForm('Delete');

        self::assertSame($originalNumObjectsInRepository, count($this->repository->findAll()));
        self::assertResponseRedirects('/pre/registration/');
    }
}
